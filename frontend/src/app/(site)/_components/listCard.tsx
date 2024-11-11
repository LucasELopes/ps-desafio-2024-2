import { bookType } from "@/types/book"
import style from "./css/listCard.module.css"
import Card from "./card"
interface ListCardProps  {
    books: bookType[]
}

const ListCard = ({books}: ListCardProps) => {

    return (
        <div className={style.listCard}>
            <div className={style.listCardChild}>
                    {books && books.map((book) => (
                        <Card key={book.id} book={book}/>
                    ))
                    }
            </div>
        </div>
    )
}

export default ListCard