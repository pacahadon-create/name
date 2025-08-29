import { supabase } from './supabase'
import type { Database } from './database.types'

type Avatar = Database['public']['Tables']['ai_avatars']['Row']
type AvatarInsert = Database['public']['Tables']['ai_avatars']['Insert']
type AvatarUpdate = Database['public']['Tables']['ai_avatars']['Update']

export const createAvatar = async (avatar: AvatarInsert): Promise<Avatar> => {
  const { data, error } = await supabase
    .from('ai_avatars')
    .insert(avatar)
    .select()
    .single()
  
  if (error) throw error
  return data
}

export const getUserAvatars = async (userId: string): Promise<Avatar[]> => {
  const { data, error } = await supabase
    .from('ai_avatars')
    .select('*')
    .eq('user_id', userId)
    .order('created_at', { ascending: false })
  
  if (error) throw error
  return data || []
}

export const getAvatar = async (id: string): Promise<Avatar | null> => {
  const { data, error } = await supabase
    .from('ai_avatars')
    .select('*')
    .eq('id', id)
    .single()
  
  if (error) throw error
  return data
}

export const updateAvatar = async (id: string, updates: AvatarUpdate): Promise<Avatar> => {
  const { data, error } = await supabase
    .from('ai_avatars')
    .update({ ...updates, updated_at: new Date().toISOString() })
    .eq('id', id)
    .select()
    .single()
  
  if (error) throw error
  return data
}

export const deleteAvatar = async (id: string): Promise<void> => {
  const { error } = await supabase
    .from('ai_avatars')
    .delete()
    .eq('id', id)
  
  if (error) throw error
}