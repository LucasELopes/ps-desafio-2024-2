import {createContext, useContext} from 'react'

type SeachCategoryContext = {
    idCategory: string|null
    setIdCategory: (value: string) => void
}

export const SearchCategoryContext = createContext<SeachCategoryContext|null>(null)

export const useSeachCategoryContext = () => {
    const context = useContext(SearchCategoryContext)

    if(!context) {
        console.log('Erro ao usar o SearchCategoryContext')
    }

    return context
}