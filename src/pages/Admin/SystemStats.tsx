import React from 'react'
import { Activity, Database, Server, Clock } from 'lucide-react'

export const SystemStats: React.FC = () => {
  return (
    <div className="card">
      <h2 className="text-xl font-bold text-secondary-900 mb-6">Системная статистика</h2>
      
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div className="text-center p-4 bg-secondary-50 rounded-lg">
          <Activity className="w-8 h-8 text-green-600 mx-auto mb-2" />
          <p className="text-lg font-semibold text-secondary-900">99.9%</p>
          <p className="text-sm text-secondary-600">Uptime</p>
        </div>
        
        <div className="text-center p-4 bg-secondary-50 rounded-lg">
          <Database className="w-8 h-8 text-blue-600 mx-auto mb-2" />
          <p className="text-lg font-semibold text-secondary-900">2.1GB</p>
          <p className="text-sm text-secondary-600">Использование БД</p>
        </div>
        
        <div className="text-center p-4 bg-secondary-50 rounded-lg">
          <Server className="w-8 h-8 text-purple-600 mx-auto mb-2" />
          <p className="text-lg font-semibold text-secondary-900">45ms</p>
          <p className="text-sm text-secondary-600">Ср. время ответа</p>
        </div>
        
        <div className="text-center p-4 bg-secondary-50 rounded-lg">
          <Clock className="w-8 h-8 text-orange-600 mx-auto mb-2" />
          <p className="text-lg font-semibold text-secondary-900">24/7</p>
          <p className="text-sm text-secondary-600">Мониторинг</p>
        </div>
      </div>
    </div>
  )
}