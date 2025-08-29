import React, { useState, useEffect } from 'react'
import { Plus, Bot, MessageCircle, Settings, Trash2 } from 'lucide-react'
import { useAuth } from '../../hooks/useAuth'
import { getUserAvatars, deleteAvatar } from '../../lib/avatars'
import { getUserConversations } from '../../lib/conversations'
import { Button } from '../../components/UI/Button'
import { LoadingSpinner } from '../../components/UI/LoadingSpinner'
import { CreateAvatarModal } from './CreateAvatarModal'
import { AvatarCard } from './AvatarCard'
import { ConversationList } from './ConversationList'
import toast from 'react-hot-toast'
import type { Database } from '../../lib/database.types'

type Avatar = Database['public']['Tables']['ai_avatars']['Row']
type Conversation = Database['public']['Tables']['conversations']['Row']

export const Dashboard: React.FC = () => {
  const { user, profile } = useAuth()
  const [avatars, setAvatars] = useState<Avatar[]>([])
  const [conversations, setConversations] = useState<Conversation[]>([])
  const [loading, setLoading] = useState(true)
  const [showCreateModal, setShowCreateModal] = useState(false)

  useEffect(() => {
    if (user) {
      loadData()
    }
  }, [user])

  const loadData = async () => {
    if (!user) return
    
    try {
      const [avatarsData, conversationsData] = await Promise.all([
        getUserAvatars(user.id),
        getUserConversations(user.id)
      ])
      
      setAvatars(avatarsData)
      setConversations(conversationsData)
    } catch (error) {
      toast.error('Ошибка загрузки данных')
    } finally {
      setLoading(false)
    }
  }

  const handleDeleteAvatar = async (id: string) => {
    if (!confirm('Вы уверены, что хотите удалить этого аватара?')) return
    
    try {
      await deleteAvatar(id)
      setAvatars(avatars.filter(avatar => avatar.id !== id))
      toast.success('Аватар удален')
    } catch (error) {
      toast.error('Ошибка удаления аватара')
    }
  }

  const handleAvatarCreated = (newAvatar: Avatar) => {
    setAvatars([newAvatar, ...avatars])
    setShowCreateModal(false)
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
          Добро пожаловать, {profile?.full_name || user?.email}!
        </h1>
        <p className="text-secondary-600">
          Управляйте своими ИИ-аватарами и разговорами
        </p>
      </div>

      {/* Stats */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div className="card">
          <div className="flex items-center">
            <Bot className="w-8 h-8 text-primary-600 mr-3" />
            <div>
              <p className="text-2xl font-bold text-secondary-900">{avatars.length}</p>
              <p className="text-secondary-600">ИИ-аватаров</p>
            </div>
          </div>
        </div>
        
        <div className="card">
          <div className="flex items-center">
            <MessageCircle className="w-8 h-8 text-primary-600 mr-3" />
            <div>
              <p className="text-2xl font-bold text-secondary-900">{conversations.length}</p>
              <p className="text-secondary-600">Разговоров</p>
            </div>
          </div>
        </div>
        
        <div className="card">
          <div className="flex items-center">
            <Settings className="w-8 h-8 text-primary-600 mr-3" />
            <div>
              <p className="text-sm font-medium text-primary-600 uppercase tracking-wide">
                {profile?.subscription_status || 'free'}
              </p>
              <p className="text-secondary-600">Тарифный план</p>
            </div>
          </div>
        </div>
      </div>

      {/* Avatars Section */}
      <div className="mb-8">
        <div className="flex items-center justify-between mb-6">
          <h2 className="text-2xl font-bold text-secondary-900">Мои ИИ-аватары</h2>
          <Button onClick={() => setShowCreateModal(true)}>
            <Plus className="w-4 h-4 mr-2" />
            Создать аватара
          </Button>
        </div>

        {avatars.length === 0 ? (
          <div className="card text-center py-12">
            <Bot className="w-16 h-16 text-secondary-400 mx-auto mb-4" />
            <h3 className="text-lg font-medium text-secondary-900 mb-2">
              У вас пока нет ИИ-аватаров
            </h3>
            <p className="text-secondary-600 mb-6">
              Создайте своего первого ИИ-аватара с уникальной личностью
            </p>
            <Button onClick={() => setShowCreateModal(true)}>
              <Plus className="w-4 h-4 mr-2" />
              Создать первого аватара
            </Button>
          </div>
        ) : (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {avatars.map((avatar) => (
              <AvatarCard
                key={avatar.id}
                avatar={avatar}
                onDelete={handleDeleteAvatar}
              />
            ))}
          </div>
        )}
      </div>

      {/* Recent Conversations */}
      <div>
        <h2 className="text-2xl font-bold text-secondary-900 mb-6">Последние разговоры</h2>
        <ConversationList conversations={conversations.slice(0, 5)} />
      </div>

      {showCreateModal && (
        <CreateAvatarModal
          onClose={() => setShowCreateModal(false)}
          onAvatarCreated={handleAvatarCreated}
        />
      )}
    </div>
  )
}