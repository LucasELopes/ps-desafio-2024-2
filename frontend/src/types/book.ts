import { categoryType } from "./category"

export type bookType = {
    id: string
    title: string
    author: string
    release_date: Date
    image: string
    categories: categoryType[]
    amount: Number
}