import React from 'react'
import { Link } from 'react-router-dom'
import { MessageCircle, Clock } from 'lucide-react'
import { formatDate, truncateText } from '../../lib/utils'
import type { Database } from '../../lib/database.types'

type Conversation = Database['public']['Tables']['conversations']['Row']

interface ConversationListProps {
  conversations: Conversation[]
}

export const ConversationList: React.FC<ConversationListProps> = ({ conversations }) => {
  if (conversations.length === 0) {
    return (
      <div className="card text-center py-8">
        <MessageCircle className="w-12 h-12 text-secondary-400 mx-auto mb-4" />
        <p className="text-secondary-600">Пока нет разговоров</p>
      </div>
    )
  }

  return (
    <div className="space-y-4">
      {conversations.map((conversation) => (
        <Link
          key={conversation.id}
          to={`/chat/${conversation.avatar_id}?conversation=${conversation.id}`}
          className="card hover:shadow-lg transition-all duration-300 block"
        >
          <div className="flex items-center justify-between">
            <div className="flex items-center space-x-3">
              <MessageCircle className="w-5 h-5 text-primary-600" />
              <div>
                <h3 className="font-medium text-secondary-900">
                  {truncateText(conversation.title, 50)}
                </h3>
                <div className="flex items-center text-sm text-secondary-500 mt-1">
                  <Clock className="w-4 h-4 mr-1" />
                  {formatDate(conversation.updated_at)}
                </div>
              </div>
            </div>
          </div>
        </Link>
      ))}
    </div>
  )
}