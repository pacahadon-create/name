import React, { useState, useEffect, useRef } from 'react'
import { useParams, useSearchParams } from 'react-router-dom'
import { Send, Bot, User, ArrowLeft } from 'lucide-react'
import { Link } from 'react-router-dom'
import { useAuth } from '../../hooks/useAuth'
import { getAvatar } from '../../lib/avatars'
import { 
  createConversation, 
  getConversationMessages, 
  addMessage 
} from '../../lib/conversations'
import { sendMessageToDeepSeek } from '../../lib/deepseek'
import { Button } from '../../components/UI/Button'
import { Input } from '../../components/UI/Input'
import { LoadingSpinner } from '../../components/UI/LoadingSpinner'
import toast from 'react-hot-toast'
import type { Database } from '../../lib/database.types'

type Avatar = Database['public']['Tables']['ai_avatars']['Row']
type Message = Database['public']['Tables']['messages']['Row']

export const Chat: React.FC = () => {
  const { avatarId } = useParams<{ avatarId: string }>()
  const [searchParams] = useSearchParams()
  const conversationId = searchParams.get('conversation')
  const { user } = useAuth()
  
  const [avatar, setAvatar] = useState<Avatar | null>(null)
  const [messages, setMessages] = useState<Message[]>([])
  const [currentConversationId, setCurrentConversationId] = useState<string | null>(conversationId)
  const [inputMessage, setInputMessage] = useState('')
  const [loading, setLoading] = useState(true)
  const [sending, setSending] = useState(false)
  
  const messagesEndRef = useRef<HTMLDivElement>(null)

  useEffect(() => {
    if (avatarId) {
      loadAvatar()
    }
  }, [avatarId])

  useEffect(() => {
    if (currentConversationId) {
      loadMessages()
    }
  }, [currentConversationId])

  useEffect(() => {
    scrollToBottom()
  }, [messages])

  const loadAvatar = async () => {
    if (!avatarId) return
    
    try {
      const avatarData = await getAvatar(avatarId)
      setAvatar(avatarData)
    } catch (error) {
      toast.error('Ошибка загрузки аватара')
    } finally {
      setLoading(false)
    }
  }

  const loadMessages = async () => {
    if (!currentConversationId) return
    
    try {
      const messagesData = await getConversationMessages(currentConversationId)
      setMessages(messagesData)
    } catch (error) {
      toast.error('Ошибка загрузки сообщений')
    }
  }

  const scrollToBottom = () => {
    messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' })
  }

  const handleSendMessage = async (e: React.FormEvent) => {
    e.preventDefault()
    if (!inputMessage.trim() || !user || !avatar || sending) return

    setSending(true)
    
    try {
      let conversationIdToUse = currentConversationId

      // Create new conversation if needed
      if (!conversationIdToUse) {
        const conversation = await createConversation({
          user_id: user.id,
          avatar_id: avatar.id,
          title: inputMessage.slice(0, 50),
        })
        conversationIdToUse = conversation.id
        setCurrentConversationId(conversationIdToUse)
      }

      // Add user message
      const userMessage = await addMessage({
        conversation_id: conversationIdToUse,
        content: inputMessage,
        role: 'user',
      })

      setMessages(prev => [...prev, userMessage])
      setInputMessage('')

      // Get AI response
      const deepseekMessages = messages.map(msg => ({
        role: msg.role as 'user' | 'assistant',
        content: msg.content,
      }))
      
      deepseekMessages.push({
        role: 'user',
        content: inputMessage,
      })

      // Note: In a real app, you'd store the DeepSeek API key securely
      // For demo purposes, we'll simulate a response
      const aiResponse = `Это демо-ответ от аватара "${avatar.name}". В реальном приложении здесь будет ответ от DeepSeek API на основе личности: "${avatar.personality}"`

      // Add AI message
      const aiMessage = await addMessage({
        conversation_id: conversationIdToUse,
        content: aiResponse,
        role: 'assistant',
      })

      setMessages(prev => [...prev, aiMessage])
    } catch (error: any) {
      toast.error(error.message || 'Ошибка отправки сообщения')
    } finally {
      setSending(false)
    }
  }

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <LoadingSpinner />
      </div>
    )
  }

  if (!avatar) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <h1 className="text-2xl font-bold text-secondary-900 mb-4">
            Аватар не найден
          </h1>
          <Link to="/dashboard">
            <Button>Вернуться к дашборду</Button>
          </Link>
        </div>
      </div>
    )
  }

  return (
    <div className="h-screen flex flex-col">
      {/* Header */}
      <div className="bg-white border-b border-secondary-200 px-4 py-4">
        <div className="max-w-4xl mx-auto flex items-center justify-between">
          <div className="flex items-center space-x-4">
            <Link to="/dashboard">
              <Button variant="ghost" size="sm">
                <ArrowLeft className="w-4 h-4 mr-2" />
                Назад
              </Button>
            </Link>
            <div className="flex items-center space-x-3">
              <div className="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                <Bot className="w-5 h-5 text-primary-600" />
              </div>
              <div>
                <h1 className="font-semibold text-secondary-900">{avatar.name}</h1>
                <p className="text-sm text-secondary-500">ИИ-аватар</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Messages */}
      <div className="flex-1 overflow-y-auto px-4 py-6">
        <div className="max-w-4xl mx-auto space-y-6">
          {messages.length === 0 ? (
            <div className="text-center py-12">
              <Bot className="w-16 h-16 text-secondary-400 mx-auto mb-4" />
              <h3 className="text-lg font-medium text-secondary-900 mb-2">
                Начните разговор с {avatar.name}
              </h3>
              <p className="text-secondary-600">
                Задайте вопрос или начните диалог
              </p>
            </div>
          ) : (
            messages.map((message) => (
              <div
                key={message.id}
                className={`flex ${message.role === 'user' ? 'justify-end' : 'justify-start'}`}
              >
                <div className={`flex items-start space-x-3 max-w-3xl ${
                  message.role === 'user' ? 'flex-row-reverse space-x-reverse' : ''
                }`}>
                  <div className={`w-8 h-8 rounded-lg flex items-center justify-center ${
                    message.role === 'user' 
                      ? 'bg-primary-600' 
                      : 'bg-secondary-200'
                  }`}>
                    {message.role === 'user' ? (
                      <User className="w-4 h-4 text-white" />
                    ) : (
                      <Bot className="w-4 h-4 text-secondary-600" />
                    )}
                  </div>
                  <div className={`rounded-lg px-4 py-3 ${
                    message.role === 'user'
                      ? 'bg-primary-600 text-white'
                      : 'bg-white border border-secondary-200'
                  }`}>
                    <p className="whitespace-pre-wrap">{message.content}</p>
                    <p className={`text-xs mt-2 ${
                      message.role === 'user' ? 'text-primary-200' : 'text-secondary-500'
                    }`}>
                      {formatDate(message.created_at)}
                    </p>
                  </div>
                </div>
              </div>
            ))
          )}
          
          {sending && (
            <div className="flex justify-start">
              <div className="flex items-start space-x-3 max-w-3xl">
                <div className="w-8 h-8 bg-secondary-200 rounded-lg flex items-center justify-center">
                  <Bot className="w-4 h-4 text-secondary-600" />
                </div>
                <div className="bg-white border border-secondary-200 rounded-lg px-4 py-3">
                  <div className="flex items-center space-x-2">
                    <div className="animate-pulse flex space-x-1">
                      <div className="w-2 h-2 bg-secondary-400 rounded-full"></div>
                      <div className="w-2 h-2 bg-secondary-400 rounded-full"></div>
                      <div className="w-2 h-2 bg-secondary-400 rounded-full"></div>
                    </div>
                    <span className="text-sm text-secondary-500">печатает...</span>
                  </div>
                </div>
              </div>
            </div>
          )}
          
          <div ref={messagesEndRef} />
        </div>
      </div>

      {/* Input */}
      <div className="bg-white border-t border-secondary-200 px-4 py-4">
        <div className="max-w-4xl mx-auto">
          <form onSubmit={handleSendMessage} className="flex items-center space-x-4">
            <div className="flex-1">
              <Input
                value={inputMessage}
                onChange={(e) => setInputMessage(e.target.value)}
                placeholder="Напишите сообщение..."
                disabled={sending}
              />
            </div>
            <Button
              type="submit"
              disabled={!inputMessage.trim() || sending}
              loading={sending}
            >
              <Send className="w-4 h-4" />
            </Button>
          </form>
        </div>
      </div>
    </div>
  )
}