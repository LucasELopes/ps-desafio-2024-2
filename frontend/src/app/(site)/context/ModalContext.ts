import { bookType } from "@/types/book"
import { createContext, useContext } from "react"

interface ModalContextProps {
    isOpen: boolean
    setIsOpen: (value: boolean) => void

    bookModal: bookType | null
    setBookModal: (value:bookType) => void 
}

export const ModalContext = createContext<ModalContextProps|null>(null)

export const useModalContext = () => {
    const context = useContext(ModalContext)

    if(!context) {
        console.log('Erro ao usar o ModalContextProps')
    }

    return context
}