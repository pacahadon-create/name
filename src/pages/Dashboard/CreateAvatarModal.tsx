import React, { useState } from 'react'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import { X, Bot, Upload } from 'lucide-react'
import { useAuth } from '../../hooks/useAuth'
import { createAvatar } from '../../lib/avatars'
import { Button } from '../../components/UI/Button'
import { Input } from '../../components/UI/Input'
import { Textarea } from '../../components/UI/Textarea'
import toast from 'react-hot-toast'
import type { Database } from '../../lib/database.types'

type Avatar = Database['public']['Tables']['ai_avatars']['Row']

const avatarSchema = z.object({
  name: z.string().min(2, 'Имя должно содержать минимум 2 символа'),
  description: z.string().optional(),
  personality: z.string().min(10, 'Описание личности должно содержать минимум 10 символов'),
  knowledgeBase: z.string().optional(),
})

type AvatarForm = z.infer<typeof avatarSchema>

interface CreateAvatarModalProps {
  onClose: () => void
  onAvatarCreated: (avatar: Avatar) => void
}

export const CreateAvatarModal: React.FC<CreateAvatarModalProps> = ({
  onClose,
  onAvatarCreated,
}) => {
  const { user } = useAuth()
  const [loading, setLoading] = useState(false)
  
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<AvatarForm>({
    resolver: zodResolver(avatarSchema),
  })

  const onSubmit = async (data: AvatarForm) => {
    if (!user) return
    
    setLoading(true)
    try {
      const avatar = await createAvatar({
        user_id: user.id,
        name: data.name,
        description: data.description || null,
        personality: data.personality,
        knowledge_base: data.knowledgeBase || null,
        is_active: true,
      })
      
      toast.success('ИИ-аватар успешно создан!')
      onAvatarCreated(avatar)
    } catch (error: any) {
      toast.error(error.message || 'Ошибка создания аватара')
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div className="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div className="flex items-center justify-between p-6 border-b border-secondary-200">
          <h2 className="text-xl font-bold text-secondary-900">Создать ИИ-аватара</h2>
          <button
            onClick={onClose}
            className="text-secondary-400 hover:text-secondary-600 transition-colors"
          >
            <X className="w-6 h-6" />
          </button>
        </div>

        <form onSubmit={handleSubmit(onSubmit)} className="p-6 space-y-6">
          <Input
            {...register('name')}
            label="Имя аватара"
            placeholder="Например: Помощник по продажам"
            error={errors.name?.message}
          />

          <Textarea
            {...register('description')}
            label="Описание (необязательно)"
            placeholder="Краткое описание назначения аватара"
            rows={3}
            error={errors.description?.message}
          />

          <Textarea
            {...register('personality')}
            label="Личность и стиль общения"
            placeholder="Опишите, как должен общаться ваш аватар: формально или дружелюбно, какие знания у него есть, какой у него характер..."
            rows={4}
            error={errors.personality?.message}
          />

          <Textarea
            {...register('knowledgeBase')}
            label="База знаний (необязательно)"
            placeholder="Добавьте специфическую информацию, которую должен знать ваш аватар: факты о компании, продуктах, процедурах..."
            rows={6}
            error={errors.knowledgeBase?.message}
          />

          <div className="flex items-center justify-end space-x-4 pt-4 border-t border-secondary-200">
            <Button
              type="button"
              variant="outline"
              onClick={onClose}
            >
              Отмена
            </Button>
            <Button
              type="submit"
              loading={loading}
            >
              <Bot className="w-4 h-4 mr-2" />
              Создать аватара
            </Button>
          </div>
        </form>
      </div>
    </div>
  )
}