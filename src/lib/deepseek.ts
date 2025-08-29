const DEEPSEEK_API_URL = 'https://api.deepseek.com/v1/chat/completions'

export interface DeepSeekMessage {
  role: 'user' | 'assistant' | 'system'
  content: string
}

export interface DeepSeekResponse {
  choices: Array<{
    message: {
      content: string
      role: string
    }
  }>
}

export const sendMessageToDeepSeek = async (
  messages: DeepSeekMessage[],
  apiKey: string,
  personality?: string,
  knowledgeBase?: string
): Promise<string> => {
  const systemMessage: DeepSeekMessage = {
    role: 'system',
    content: `${personality || 'You are a helpful AI assistant.'} ${
      knowledgeBase ? `\n\nKnowledge Base:\n${knowledgeBase}` : ''
    }`
  }

  const response = await fetch(DEEPSEEK_API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${apiKey}`,
    },
    body: JSON.stringify({
      model: 'deepseek-chat',
      messages: [systemMessage, ...messages],
      temperature: 0.7,
      max_tokens: 2000,
    }),
  })

  if (!response.ok) {
    throw new Error(`DeepSeek API error: ${response.statusText}`)
  }

  const data: DeepSeekResponse = await response.json()
  return data.choices[0]?.message?.content || 'No response received'
}