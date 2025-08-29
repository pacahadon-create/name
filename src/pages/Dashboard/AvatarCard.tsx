import React from 'react'
import { Link } from 'react-router-dom'
import { Bot, MessageCircle, Settings, Trash2 } from 'lucide-react'
import { Button } from '../../components/UI/Button'
import { formatDate, truncateText } from '../../lib/utils'
import type { Database } from '../../lib/database.types'

type Avatar = Database['public']['Tables']['ai_avatars']['Row']

interface AvatarCardProps {
  avatar: Avatar
  onDelete: (id: string) => void
}

export const AvatarCard: React.FC<AvatarCardProps> = ({ avatar, onDelete }) => {
  return (
    <div className="card hover:shadow-lg transition-all duration-300 group">
      <div className="flex items-start justify-between mb-4">
        <div className="flex items-center space-x-3">
          <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
            <Bot className="w-6 h-6 text-primary-600" />
          </div>
          <div>
            <h3 className="font-semibold text-secondary-900">{avatar.name}</h3>
            <p className="text-sm text-secondary-500">
              Создан {formatDate(avatar.created_at)}
            </p>
          </div>
        </div>
        
        <div className="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <Button
            variant="ghost"
            size="sm"
            onClick={() => onDelete(avatar.id)}
            className="text-red-600 hover:text-red-700 hover:bg-red-50"
          >
            <Trash2 className="w-4 h-4" />
          </Button>
        </div>
      </div>

      {avatar.description && (
        <p className="text-secondary-600 mb-4">
          {truncateText(avatar.description, 100)}
        </p>
      )}

      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-4">
          <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
            avatar.is_active 
              ? 'bg-green-100 text-green-800' 
              : 'bg-secondary-100 text-secondary-800'
          }`}>
            {avatar.is_active ? 'Активен' : 'Неактивен'}
          </span>
        </div>
        
        <div className="flex items-center space-x-2">
          <Link to={`/chat/${avatar.id}`}>
            <Button size="sm">
              <MessageCircle className="w-4 h-4 mr-1" />
              Чат
            </Button>
          </Link>
        </div>
      </div>
    </div>
  )
}