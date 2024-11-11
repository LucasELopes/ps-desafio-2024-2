import { bookType } from "@/types/book"
import style from './css/modal.module.css'
import { useModalContext } from "../context/ModalContext"
import { useEffect, useState } from "react"
import { updateBook } from "@/actions/book"
import { api } from "@/services/api"
import { filterFormData } from "@/services/filter-form-data"

interface ModalProps {
    book?: bookType
}

const Modal = ({book}: ModalProps) => {
    const context = useModalContext()
    const [amountModal, setAmountModal] = useState<Number>(book?.amount)

    useEffect(() => {
        const buyBook = async () => {
            const form = new FormData()
            
            form.append('id', book?.id)
            form.append('amount', amountModal.toString())
            
            const newForm = await filterFormData(form)
            const { error } = await JSON.parse(await updateBook(newForm))
        }
        buyBook()
    }, [amountModal])

    return (
        <div className={style.containerModal}>
            <dialog open>
                <div className={style.closeModal}>
                <img
                    src="./close.png"
                    alt="close"
                    onClick={() => {
                        context?.setIsOpen(false);
                        if (amountModal !== book?.amount) {
                            window.location.reload();
                        }
                    }}
                />
                </div>
                <div className={style.categoryModal}>
                    {book?.categories.map((e) => (e.name))}
                </div>
                <div className={style.imageModal}>
                    <img src={book?.image} alt="image"/>
                </div>
                <div>
                    <span className={style.idModal}>
                        {" " + book?.id}
                    </span>
                </div>
                <div className={style.infos}>
                    <div>
                        <div className={style.titleModal}>
                            Título: 
                        </div>
                        <div className={style.titleModalInfo}>
                            {" " + book?.title}
                        </div>
                    </div>
                    <div>
                        <div className={style.authorModal}>
                            Autor:
                        </div>
                        <div className={style.authorModalInfo}>
                            {" " + book?.author}
                        </div>
                    </div>
                    <div>
                        <div className={style.releaseModal}>
                            Lançamento: 
                        </div>
                        <div className={style.releaseModalInfo}>
                            {book && " " + (new Date(book.release_date).toLocaleString()).split(',')[0]}
                        </div>
                    </div>
                    <div>
                        <div className={style.releaseModal}>
                            Quantidade: 
                        </div>
                        <div className={style.releaseModalInfo}>
                            {book && amountModal} unidades
                        </div>
                    </div>
                </div>
                <div className={style.buyModalContainer}>
                    <button
                        onClick={() => setAmountModal(amountModal - 1)}
                        disabled={amountModal <= 0}
                    >
                        Comprar
                    </button>
                </div>
            </dialog>
        </div>
    )

}

export default Modal