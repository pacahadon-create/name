import React, { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import { Bot, Mail, Lock, User } from 'lucide-react'
import { signUp } from '../../lib/auth'
import { Button } from '../../components/UI/Button'
import { Input } from '../../components/UI/Input'
import toast from 'react-hot-toast'

const registerSchema = z.object({
  fullName: z.string().min(2, 'Имя должно содержать минимум 2 символа'),
  email: z.string().email('Введите корректный email'),
  password: z.string().min(6, 'Пароль должен содержать минимум 6 символов'),
  confirmPassword: z.string(),
}).refine((data) => data.password === data.confirmPassword, {
  message: 'Пароли не совпадают',
  path: ['confirmPassword'],
})

type RegisterForm = z.infer<typeof registerSchema>

export const Register: React.FC = () => {
  const [loading, setLoading] = useState(false)
  const navigate = useNavigate()
  
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<RegisterForm>({
    resolver: zodResolver(registerSchema),
  })

  const onSubmit = async (data: RegisterForm) => {
    setLoading(true)
    try {
      await signUp(data.email, data.password, data.fullName)
      toast.success('Аккаунт успешно создан!')
      navigate('/dashboard')
    } catch (error: any) {
      toast.error(error.message || 'Ошибка регистрации')
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="min-h-screen gradient-bg flex items-center justify-center py-12 px-4">
      <div className="max-w-md w-full">
        <div className="card animate-slide-up">
          <div className="text-center mb-8">
            <Bot className="w-12 h-12 text-primary-600 mx-auto mb-4" />
            <h1 className="text-2xl font-bold text-secondary-900 mb-2">
              Создать аккаунт
            </h1>
            <p className="text-secondary-600">
              Зарегистрируйтесь для создания ИИ-аватаров
            </p>
          </div>

          <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
            <div className="relative">
              <User className="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400" />
              <Input
                {...register('fullName')}
                type="text"
                placeholder="Ваше имя"
                className="pl-10"
                error={errors.fullName?.message}
              />
            </div>

            <div className="relative">
              <Mail className="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400" />
              <Input
                {...register('email')}
                type="email"
                placeholder="Ваш email"
                className="pl-10"
                error={errors.email?.message}
              />
            </div>

            <div className="relative">
              <Lock className="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400" />
              <Input
                {...register('password')}
                type="password"
                placeholder="Пароль"
                className="pl-10"
                error={errors.password?.message}
              />
            </div>

            <div className="relative">
              <Lock className="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-secondary-400" />
              <Input
                {...register('confirmPassword')}
                type="password"
                placeholder="Подтвердите пароль"
                className="pl-10"
                error={errors.confirmPassword?.message}
              />
            </div>

            <Button
              type="submit"
              className="w-full"
              loading={loading}
            >
              Создать аккаунт
            </Button>
          </form>

          <div className="mt-6 text-center">
            <p className="text-secondary-600">
              Уже есть аккаунт?{' '}
              <Link
                to="/login"
                className="text-primary-600 hover:text-primary-700 font-medium"
              >
                Войти
              </Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  )
}