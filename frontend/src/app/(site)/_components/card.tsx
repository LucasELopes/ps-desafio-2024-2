import { bookType } from "@/types/book"
import style from "./css/card.module.css"

interface CardProps {
    book: bookType   
}

const Card = ({book}: CardProps) => {
    return (
        <div className={style.card}>
            <img  src={book.image} alt="imageBook" />
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