import React from 'react'
import { Link } from 'react-router-dom'
import { Bot, Zap, Shield, Users, ArrowRight, Star } from 'lucide-react'
import { Button } from '../components/UI/Button'

export const Landing: React.FC = () => {
  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="gradient-bg py-20 px-4">
        <div className="max-w-6xl mx-auto text-center">
          <div className="animate-fade-in">
            <h1 className="text-5xl md:text-7xl font-bold text-secondary-900 mb-6 text-balance">
              Создайте своего
              <span className="text-primary-600 block">ИИ Аватара</span>
            </h1>
            <p className="text-xl md:text-2xl text-secondary-600 mb-8 max-w-3xl mx-auto text-balance">
              Персонализированный ИИ-помощник с собственной базой знаний, 
              который понимает ваш бизнес и говорит вашим голосом
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link to="/register">
                <Button size="lg" className="w-full sm:w-auto">
                  Начать бесплатно
                  <ArrowRight className="ml-2 w-5 h-5" />
                </Button>
              </Link>
              <Link to="/login">
                <Button variant="outline" size="lg" className="w-full sm:w-auto">
                  Войти в аккаунт
                </Button>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 px-4 bg-white">
        <div className="max-w-6xl mx-auto">
          <div className="text-center mb-16">
            <h2 className="text-4xl font-bold text-secondary-900 mb-4">
              Возможности платформы
            </h2>
            <p className="text-xl text-secondary-600 max-w-2xl mx-auto">
              Мощные инструменты для создания и управления ИИ-аватарами
            </p>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div className="card hover:shadow-lg transition-shadow duration-300">
              <Bot className="w-12 h-12 text-primary-600 mb-4" />
              <h3 className="text-xl font-semibold text-secondary-900 mb-2">
                Персонализация
              </h3>
              <p className="text-secondary-600">
                Настройте личность, стиль общения и базу знаний вашего ИИ-аватара
              </p>
            </div>

            <div className="card hover:shadow-lg transition-shadow duration-300">
              <Zap className="w-12 h-12 text-primary-600 mb-4" />
              <h3 className="text-xl font-semibold text-secondary-900 mb-2">
                Быстрые ответы
              </h3>
              <p className="text-secondary-600">
                Мгновенные ответы на основе DeepSeek API с высокой точностью
              </p>
            </div>

            <div className="card hover:shadow-lg transition-shadow duration-300">
              <Shield className="w-12 h-12 text-primary-600 mb-4" />
              <h3 className="text-xl font-semibold text-secondary-900 mb-2">
                Безопасность
              </h3>
              <p className="text-secondary-600">
                Защищенное хранение данных и конфиденциальность разговоров
              </p>
            </div>

            <div className="card hover:shadow-lg transition-shadow duration-300">
              <Users className="w-12 h-12 text-primary-600 mb-4" />
              <h3 className="text-xl font-semibold text-secondary-900 mb-2">
                Командная работа
              </h3>
              <p className="text-secondary-600">
                Делитесь аватарами с командой и управляйте доступом
              </p>
            </div>

            <div className="card hover:shadow-lg transition-shadow duration-300">
              <Star className="w-12 h-12 text-primary-600 mb-4" />
              <h3 className="text-xl font-semibold text-secondary-900 mb-2">
                База знаний
              </h3>
              <p className="text-secondary-600">
                Загружайте документы и создавайте уникальную базу знаний
              </p>
            </div>

            <div className="card hover:shadow-lg transition-shadow duration-300">
              <Bot className="w-12 h-12 text-primary-600 mb-4" />
              <h3 className="text-xl font-semibold text-secondary-900 mb-2">
                API интеграция
              </h3>
              <p className="text-secondary-600">
                Интегрируйте аватаров в ваши приложения через простое API
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 px-4 bg-primary-600">
        <div className="max-w-4xl mx-auto text-center">
          <h2 className="text-4xl font-bold text-white mb-4">
            Готовы создать своего ИИ-аватара?
          </h2>
          <p className="text-xl text-primary-100 mb-8">
            Присоединяйтесь к тысячам пользователей, которые уже используют наш сервис
          </p>
          <Link to="/register">
            <Button 
              size="lg" 
              className="bg-white text-primary-600 hover:bg-primary-50 active:bg-primary-100"
            >
              Начать бесплатно
              <ArrowRight className="ml-2 w-5 h-5" />
            </Button>
          </Link>
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-secondary-900 text-white py-12 px-4">
        <div className="max-w-6xl mx-auto">
          <div className="grid md:grid-cols-4 gap-8">
            <div>
              <div className="flex items-center space-x-2 mb-4">
                <Bot className="w-6 h-6 text-primary-400" />
                <span className="text-lg font-bold">AI Avatar</span>
              </div>
              <p className="text-secondary-400">
                Создавайте персонализированных ИИ-помощников для вашего бизнеса
              </p>
            </div>
            
            <div>
              <h3 className="font-semibold mb-4">Продукт</h3>
              <ul className="space-y-2 text-secondary-400">
                <li><a href="#" className="hover:text-white transition-colors">Возможности</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Тарифы</a></li>
                <li><a href="#" className="hover:text-white transition-colors">API</a></li>
              </ul>
            </div>
            
            <div>
              <h3 className="font-semibold mb-4">Поддержка</h3>
              <ul className="space-y-2 text-secondary-400">
                <li><a href="#" className="hover:text-white transition-colors">Документация</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Помощь</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Контакты</a></li>
              </ul>
            </div>
            
            <div>
              <h3 className="font-semibold mb-4">Компания</h3>
              <ul className="space-y-2 text-secondary-400">
                <li><a href="#" className="hover:text-white transition-colors">О нас</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Блог</a></li>
                <li><a href="#" className="hover:text-white transition-colors">Карьера</a></li>
              </ul>
            </div>
          </div>
          
          <div className="border-t border-secondary-800 mt-8 pt-8 text-center text-secondary-400">
            <p>&copy; 2025 AI Avatar. Все права защищены.</p>
          </div>
        </div>
      </footer>
    </div>
  )
}