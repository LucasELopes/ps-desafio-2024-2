'use client'

import {
  DialogHeader,
  Dialog,
  DialogTrigger,
  DialogContent,
  DialogTitle,
  DialogDescription,
} from '@/components/dialog'
import FormFieldsBook from './form-fields-book'
import { bookType } from '@/types/book'
import { api } from '@/services/api'
import { useEffect, useState } from 'react'
import { useToast } from '@/components/use-toast'

interface DialogInformationBookProps {
  id: string
  children: React.ReactNode
  isInformation?: boolean
}

export function DialogInformationBook({
  id,
  children,
}: DialogInformationBookProps) {
  const [book, setBook] = useState<bookType | null>(null)
  const [open, setOpen] = useState<boolean>()
  const { toast } = useToast()

  useEffect(() => {
    const requestData = async () => {
      const { response } = null // requisicao para api

      if (response) {
        setBook(response)
      } else {
        setBook(null)
        toast({
          title: 'Livro não encontrado!',
        })
        setOpen(false)
      }
    }

    requestData()

    return () => setBook(null)
  }, [id, open, toast])

  return (
    <Dialog open={open} onOpenChange={setOpen}>
      <DialogTrigger asChild>{children}</DialogTrigger>
      <DialogContent>
        <DialogHeader>
          <DialogTitle>Informações do livro</DialogTitle>
          <DialogDescription>
            Visualize as informações detalhadas do livro abaixo.
          </DialogDescription>
        </DialogHeader>
        <FormFieldsBook book={book} readOnly />
      </DialogContent>
    </Dialog>
  )
}