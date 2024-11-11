import { bookType } from "@/types/book"
import style from "./css/card.module.css"
import { useModalContext } from "../context/ModalContext"

interface CardProps {
    book: bookType   
}

const Card = ({book}: CardProps) => {

    const context = useModalContext()

    return (
        <div className={style.card} onClick={() => {context?.setIsOpen(true); context?.setBookModal(book)}}>
            <img  src={book.image} alt="imageBook"/>
            <div className={style.category}>
                {book.categories.map((e) => (e.name))}
            </div>
            <div className={style.title}>
                {book.title}
            </div>
        </div>
    )
}

export default Card