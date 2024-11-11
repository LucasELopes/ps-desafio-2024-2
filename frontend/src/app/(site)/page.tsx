'use client'

import { useEffect, useState } from 'react'
import style from './styles.module.css'
import { bookType } from '@/types/book'
import { useToast } from '@/components/use-toast'
import { api } from '@/services/api'
import Loading from './_components/loading'
import Card from './_components/card'
import ListCard from './_components/listCard'
import { useSeachCategoryContext } from './context/SearchCategoryContext'

export default function Home() {

  const [books, setBooks] = useState<bookType[] | undefined>()
  const [loading, setLoading] = useState(true)
  const context = useSeachCategoryContext()

  useEffect(() =>{
    const resquestData = async () => {
      const {response} = await api<bookType[]>('GET', '/books')
      
      if(response) {
        setBooks(response)
      }
    }

    const requestBookInCategory = async () => {
      const {response} = await api<bookType[]>('GET', `/books/category/${context?.idCategory}`)

      if(response) {
        setBooks(response)
      }
    }

    if(!context?.idCategory) {
      resquestData().then(() => setLoading(false))
    }
    else {
      requestBookInCategory().then(() => setLoading(false))
    }

  },[context?.idCategory])

  if(loading ) {
    return (
      <Loading/>
    )
  }
  else if(books) {
    return (
      <ListCard books={books}/>
    )
  }
  else if(!loading && !books) {
    return (
      <div className={style.infContainer}>
        <div className={style.inf}>
          <a href="/">
            Não há livros para serem exibidos
          </a>
        </div>
      </div>
    )
  }
}
