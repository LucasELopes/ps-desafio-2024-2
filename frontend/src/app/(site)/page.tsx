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
import Modal from './_components/modal'
import { ModalContext } from './context/ModalContext'

export default function Home() {

  const [books, setBooks] = useState<bookType[]>()
  const [loading, setLoading] = useState(true)

  const [bookModal, setBookModal] = useState<bookType|null>(null)
  const [isOpen, setIsOpen] = useState(false)

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

    const showBook = async (name: string|number) => {
      const {response} = await api<bookType[]>('GET', `/books/${name}`)

      
      if(response) {
        setBooks(response)
      }

      console.log(books)
    }

    if(!context?.idCategory && !context?.idSearchBook) {
      resquestData().then(() => setLoading(false))
      // alert('1')
    }
    else if(!context.idSearchBook && context.idCategory) {
      requestBookInCategory().then(() => setLoading(false))
      // alert('2')
    }
    else if(context.idSearchBook && !context.idCategory) {
      showBook(context.idSearchBook).then(() => setLoading(false))
      // alert("3")
    }

    // alert(context?.idSearchBook)
  },[context?.idCategory, context?.idSearchBook])

  if(loading ) {
    return (
      <Loading/>
    )
  }
  else if(books) {
    return (
      <ModalContext.Provider value={{isOpen, setIsOpen, bookModal, setBookModal}}>
        <ListCard books={books}/>
        {
        isOpen && bookModal &&
          <Modal book={bookModal}/>
        }
      </ModalContext.Provider>
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
