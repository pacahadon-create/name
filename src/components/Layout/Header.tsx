import React from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { LogOut, User, Settings, Bot } from 'lucide-react'
import { useAuth } from '../../hooks/useAuth'
import { signOut } from '../../lib/auth'
import toast from 'react-hot-toast'

export const Header: React.FC = () => {
  const { user, profile, isAuthenticated } = useAuth()
  const navigate = useNavigate()

  const handleSignOut = async () => {
    try {
      await signOut()
      toast.success('Вы успешно вышли из системы')
      navigate('/')
    } catch (error) {
      toast.error('Ошибка при выходе из системы')
    }
  }

  return (
    <header className="bg-white border-b border-secondary-200 sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <Link to="/" className="flex items-center space-x-2">
            <Bot className="w-8 h-8 text-primary-600" />
            <span className="text-xl font-bold text-secondary-900">AI Avatar</span>
          </Link>

          <nav className="hidden md:flex items-center space-x-8">
            {isAuthenticated ? (
              <>
                <Link
                  to="/dashboard"
                  className="text-secondary-700 hover:text-primary-600 transition-colors"
                >
                  Дашборд
                </Link>
                {profile?.role === 'admin' && (
                  <Link
                    to="/admin"
                    className="text-secondary-700 hover:text-primary-600 transition-colors"
                  >
                    Админка
                  </Link>
                )}
              </>
            ) : (
              <>
                <Link
                  to="/login"
                  className="text-secondary-700 hover:text-primary-600 transition-colors"
                >
                  Вход
                </Link>
                <Link
                  to="/register"
                  className="btn-primary"
                >
                  Регистрация
                </Link>
              </>
            )}
          </nav>

          {isAuthenticated && (
            <div className="flex items-center space-x-4">
              <div className="relative group">
                <button className="flex items-center space-x-2 text-secondary-700 hover:text-primary-600 transition-colors">
                  <User className="w-5 h-5" />
                  <span className="hidden sm:block">{profile?.full_name || user?.email}</span>
                </button>
                
                <div className="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-secondary-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                  <div className="py-1">
                    <Link
                      to="/settings"
                      className="flex items-center px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50"
                    >
                      <Settings className="w-4 h-4 mr-2" />
                      Настройки
                    </Link>
                    <button
                      onClick={handleSignOut}
                      className="flex items-center w-full px-4 py-2 text-sm text-secondary-700 hover:bg-secondary-50"
                    >
                      <LogOut className="w-4 h-4 mr-2" />
                      Выйти
                    </button>
                  </div>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    </header>
  )
}