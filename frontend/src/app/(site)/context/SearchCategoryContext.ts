import {createContext, useContext} from 'react'

type SearchCategoryContext = {
    idCategory: string|null
    setIdCategory: (value: string) => void

    idSearchBook: string
    setIdSearchBook: (value: string) => void
}

export const SearchCategoryContext = createContext<SearchCategoryContext|null>(null)

export const useSeachCategoryContext = () => {
    const context = useContext(SearchCategoryContext)

    if(!context) {
        console.log('Erro ao usar o SearchCategoryContext')
    }

    return context
}