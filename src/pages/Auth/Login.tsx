import React, { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import { Bot, Mail, Lock } from 'lucide-react'
import { signIn } from '../../lib/auth'
import { Button } from '../../components/UI/Button'
import { Input } from '../../components/UI/Input'
import toast from 'react-hot-toast'

const loginSchema = z.object({
  email: z.string().email('Введите корректный email'),
  password: z.string().min(6, 'Пароль должен содержать минимум 6 символов'),
})

type LoginForm = z.infer<typeof loginSchema>

export const Login: React.FC = () => {
  const [loading, setLoading] = useState(false)
  const navigate = useNavigate()
  
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<LoginForm>({
    resolver: zodResolver(loginSchema),
  })

  const onSubmit = async (data: LoginForm) => {
    setLoading(true)
    try {
      await signIn(data.email, data.password)
      toast.success('Добро пожаловать!')
      navigate('/dashboard')
    } catch (error: any) {
      toast.error(error.message || 'Ошибка входа в систему')
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
              Вход в систему
            </h1>
            <p className="text-secondary-600">
              Войдите в свой аккаунт для управления ИИ-аватарами
            </p>
          </div>

          <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
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
                placeholder="Ваш пароль"
                className="pl-10"
                error={errors.password?.message}
              />
            </div>

            <Button
              type="submit"
              className="w-full"
              loading={loading}
            >
              Войти
            </Button>
          </form>

          <div className="mt-6 text-center">
            <p className="text-secondary-600">
              Нет аккаунта?{' '}
              <Link
                to="/register"
                className="text-primary-600 hover:text-primary-700 font-medium"
              >
                Зарегистрироваться
              </Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  )
}