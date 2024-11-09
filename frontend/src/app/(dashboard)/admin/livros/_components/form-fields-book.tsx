'use client'

import { Button } from '@/components/button'
import {
  FormFieldsGroup,
  FormField,
  ImageForm,
  handleImageChange,
} from '@/components/dashboard/form'
import { DialogFooter } from '@/components/dialog'
import { Input } from '@/components/input'
import { Label } from '@/components/label'
import { cn } from '@/lib/utils'
import { ResponseErrorType } from '@/services/api'
import { bookType } from '@/types/book'
import { useState } from 'react'
import { useFormStatus } from 'react-dom'

interface FormFieldsBookProps {
  book?: bookType | null
  readOnly?: boolean
  error?: ResponseErrorType | null
}

export default function FormFieldsBook({
  book,
  readOnly,
  error,
}: FormFieldsBookProps) {
  const { pending } = useFormStatus()
  const [updateImage, setUpdateImage] = useState<string | undefined>()

  return (
    <>
      <FormFieldsGroup>
        {book && <Input defaultValue={book.id} type="text" name="id" hidden />}
        <FormField>
          <Label htmlFor="title" required={!book}>
            Título
          </Label>
          <Input
            name="title"
            id="title"
            placeholder="Insira o título do livro"
            defaultValue={book?.title}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.title}
          />
        </FormField>
        <FormField>
          <Label htmlFor="author" required={!book}>
            Autor
          </Label>
          <Input
            name="author"
            id="author"
            placeholder="Insira o autor do livro"
            defaultValue={book?.author}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.author}
          />
        </FormField>
        <FormField>
          <Label htmlFor="title" required={!book}>
            Lançamento
          </Label>
          <Input
            type='date'
            name="release_date"
            id="release_date"
            placeholder="Data de lançamento"
            defaultValue={book?.release_date}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.release_date}
          />
        </FormField>
        <FormField>
          <Label htmlFor="categories" required={!book}>
            Categoria(s)
          </Label>
          <Input
            name="category_id[]"
            id="categories"
            placeholder="Insira a(s) categoria(s) do livro"
            defaultValue={book?.categories.map((e) => (e.name + ','))}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.categories}
          />
        </FormField>
        <FormField>
          <Label htmlFor="amount" required={!book}>
            Quantidade
          </Label>
          <Input
            type='number'
            name="amount"
            id="amount"
            placeholder="Insira a quantidade em estoque"
            defaultValue={book?.amount}
            disabled={pending}
            readOnly={readOnly}
            error={error?.errors?.amount}
          />
        </FormField>
        <FormField>
          <Label htmlFor="image" hidden={readOnly && !book?.image}>
            Imagem
          </Label>
          <Input
            name="image"
            id="image"
            type="file"
            accept="image/*"
            disabled={pending}
            hidden={readOnly}
            onChange={(e) => handleImageChange(e, setUpdateImage)}
            error={error?.errors?.image}
          />
          <ImageForm
            className="aspect-square size-40"
            src={updateImage || book?.image}
          />
        </FormField>
      </FormFieldsGroup>
      
      <DialogFooter className={cn({ hidden: readOnly })}>
        <Button type="submit" pending={pending}>
          Salvar
        </Button>
      </DialogFooter>
    </>
  )
}
