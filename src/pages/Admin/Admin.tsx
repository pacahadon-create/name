import React, { useState, useEffect } from 'react'
import { Users, Bot, MessageCircle, TrendingUp } from 'lucide-react'
import { supabase } from '../../lib/supabase'
import { LoadingSpinner } from '../../components/UI/LoadingSpinner'
import { UserManagement } from './UserManagement'
import { SystemStats } from './SystemStats'
import toast from 'react-hot-toast'

interface AdminStats {
  totalUsers: number
  totalAvatars: number
  totalConversations: number
  activeUsers: number
}

export const Admin: React.FC = () => {
  const [stats, setStats] = useState<AdminStats | null>(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    loadStats()
  }, [])

  const loadStats = async () => {
    try {
      const [usersResult, avatarsResult, conversationsResult] = await Promise.all([
        supabase.from('profiles').select('id', { count: 'exact' }),
        supabase.from('ai_avatars').select('id', { count: 'exact' }),
        supabase.from('conversations').select('id', { count: 'exact' }),
      ])

      setStats({
        totalUsers: usersResult.count || 0,
        totalAvatars: avatarsResult.count || 0,
        totalConversations: conversationsResult.count || 0,
        activeUsers: usersResult.count || 0, // Simplified for demo
      })
    } catch (error) {
      toast.error('Ошибка загрузки статистики')
    } finally {
      setLoading(false)
    }
  }

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <LoadingSpinner />
      </div>
    )
  }

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div className="mb-8">
        <h1 className="text-3xl font-bold text-secondary-900 mb-2">
          Панель администратора
        </h1>
        <p className="text-secondary-600">
          Управление пользователями и системой
        </p>
      </div>

      {/* Stats */}
      {stats && (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <div className="card">
            <div className="flex items-center">
              <Users className="w-8 h-8 text-primary-600 mr-3" />
              <div>
                <p className="text-2xl font-bold text-secondary-900">{stats.totalUsers}</p>
                <p className="text-secondary-600">Всего пользователей</p>
              </div>
            </div>
          </div>
          
          <div className="card">
            <div className="flex items-center">
              <Bot className="w-8 h-8 text-primary-600 mr-3" />
              <div>
                <p className="text-2xl font-bold text-secondary-900">{stats.totalAvatars}</p>
                <p className="text-secondary-600">ИИ-аватаров</p>
              </div>
            </div>
          </div>
          
          <div className="card">
            <div className="flex items-center">
              <MessageCircle className="w-8 h-8 text-primary-600 mr-3" />
              <div>
                <p className="text-2xl font-bold text-secondary-900">{stats.totalConversations}</p>
                <p className="text-secondary-600">Разговоров</p>
              </div>
            </div>
          </div>
          
          <div className="card">
            <div className="flex items-center">
              <TrendingUp className="w-8 h-8 text-primary-600 mr-3" />
              <div>
                <p className="text-2xl font-bold text-secondary-900">{stats.activeUsers}</p>
                <p className="text-secondary-600">Активных пользователей</p>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* Management Sections */}
      <div className="space-y-8">
        <UserManagement />
        <SystemStats />
      </div>
    </div>
  )
}