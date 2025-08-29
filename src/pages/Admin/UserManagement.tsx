import React, { useState, useEffect } from 'react'
import { Search, MoreVertical, Shield, User } from 'lucide-react'
import { supabase } from '../../lib/supabase'
import { updateProfile } from '../../lib/auth'
import { Button } from '../../components/UI/Button'
import { Input } from '../../components/UI/Input'
import { LoadingSpinner } from '../../components/UI/LoadingSpinner'
import { formatDate } from '../../lib/utils'
import toast from 'react-hot-toast'
import type { Database } from '../../lib/database.types'

type Profile = Database['public']['Tables']['profiles']['Row']

export const UserManagement: React.FC = () => {
  const [users, setUsers] = useState<Profile[]>([])
  const [loading, setLoading] = useState(true)
  const [searchTerm, setSearchTerm] = useState('')

  useEffect(() => {
    loadUsers()
  }, [])

  const loadUsers = async () => {
    try {
      const { data, error } = await supabase
        .from('profiles')
        .select('*')
        .order('created_at', { ascending: false })

      if (error) throw error
      setUsers(data || [])
    } catch (error) {
      toast.error('Ошибка загрузки пользователей')
    } finally {
      setLoading(false)
    }
  }

  const handleRoleChange = async (userId: string, newRole: 'user' | 'admin') => {
    try {
      await updateProfile(userId, { role: newRole })
      setUsers(users.map(user => 
        user.id === userId ? { ...user, role: newRole } : user
      ))
      toast.success('Роль пользователя обновлена')
    } catch (error) {
      toast.error('Ошибка обновления роли')
    }
  }

  const handleSubscriptionChange = async (
    userId: string, 
    newStatus: 'free' | 'pro' | 'enterprise'
  ) => {
    try {
      await updateProfile(userId, { subscription_status: newStatus })
      setUsers(users.map(user => 
        user.id === userId ? { ...user, subscription_status: newStatus } : user
      ))
      toast.success('Подписка пользователя обновлена')
    } catch (error) {
      toast.error('Ошибка обновления подписки')
    }
  }

  const filteredUsers = users.filter(user =>
    user.email.toLowerCase().includes(searchTerm.toLowerCase()) ||
    user.full_name?.toLowerCase().includes(searchTerm.toLowerCase())
  )

  if (loading) {
    return (
      <div className="card">
        <div className="flex items-center justify-center py-8">
          <LoadingSpinner />
        </div>
      </div>
    )
  }

  return (
    <div className="card">
      <div className="flex items-center justify-between mb-6">
        <h2 className="text-xl font-bold text-secondary-900">Управление пользователями</h2>
        <div className="relative">
          <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-secondary-400" />
          <Input
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            placeholder="Поиск пользователей..."
            className="pl-10 w-64"
          />
        </div>
      </div>

      <div className="overflow-x-auto">
        <table className="w-full">
          <thead>
            <tr className="border-b border-secondary-200">
              <th className="text-left py-3 px-4 font-medium text-secondary-700">Пользователь</th>
              <th className="text-left py-3 px-4 font-medium text-secondary-700">Роль</th>
              <th className="text-left py-3 px-4 font-medium text-secondary-700">Подписка</th>
              <th className="text-left py-3 px-4 font-medium text-secondary-700">Дата регистрации</th>
              <th className="text-left py-3 px-4 font-medium text-secondary-700">Действия</th>
            </tr>
          </thead>
          <tbody>
            {filteredUsers.map((user) => (
              <tr key={user.id} className="border-b border-secondary-100 hover:bg-secondary-50">
                <td className="py-3 px-4">
                  <div className="flex items-center space-x-3">
                    <div className="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                      <User className="w-4 h-4 text-primary-600" />
                    </div>
                    <div>
                      <p className="font-medium text-secondary-900">
                        {user.full_name || 'Без имени'}
                      </p>
                      <p className="text-sm text-secondary-500">{user.email}</p>
                    </div>
                  </div>
                </td>
                <td className="py-3 px-4">
                  <select
                    value={user.role}
                    onChange={(e) => handleRoleChange(user.id, e.target.value as 'user' | 'admin')}
                    className="text-sm border border-secondary-300 rounded px-2 py-1"
                  >
                    <option value="user">Пользователь</option>
                    <option value="admin">Администратор</option>
                  </select>
                </td>
                <td className="py-3 px-4">
                  <select
                    value={user.subscription_status}
                    onChange={(e) => handleSubscriptionChange(
                      user.id, 
                      e.target.value as 'free' | 'pro' | 'enterprise'
                    )}
                    className="text-sm border border-secondary-300 rounded px-2 py-1"
                  >
                    <option value="free">Бесплатный</option>
                    <option value="pro">Pro</option>
                    <option value="enterprise">Enterprise</option>
                  </select>
                </td>
                <td className="py-3 px-4 text-sm text-secondary-600">
                  {formatDate(user.created_at)}
                </td>
                <td className="py-3 px-4">
                  <Button variant="ghost" size="sm">
                    <MoreVertical className="w-4 h-4" />
                  </Button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      {filteredUsers.length === 0 && (
        <div className="text-center py-8">
          <p className="text-secondary-600">Пользователи не найдены</p>
        </div>
      )}
    </div>
  )
}