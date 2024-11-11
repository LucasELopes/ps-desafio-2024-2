'use client'
import '@/app/globals.css'
import style from './layout.module.css'
import SideBar from './_components/sideBar'
import Header from './_components/header'
import { useEffect, useState } from 'react'
import { api } from '@/services/api'
import { categoryType } from '@/types/category'
import { SearchCategoryContext } from './context/SearchCategoryContext'

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {

  const [names, setNames] = useState<string[]>([])
  const [categories, setCategories] = useState<categoryType[]>([])

  const[idCategory, setIdCategory] = useState<string|null>(null)

  useEffect(() => {
    const requestData = async () => {
      const {response} = await api<categoryType[]>('GET', `categories/`);

      if(response) {
        setCategories(response)
      }
    }
    requestData()
  }, [])

  return (
      <SearchCategoryContext.Provider value={{idCategory, setIdCategory}}>
        <div className={style.default}>
              <SideBar title='Categorias' categories={categories}/>
              <Header/>
              {children}
        </div>
      </SearchCategoryContext.Provider>
  )
}