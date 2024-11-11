import { bookType } from "@/types/book"
import style from './css/modal.module.css'
import { useModalContext } from "../context/ModalContext"

interface ModalProps {
    book?: bookType
}

const Modal = ({book}: ModalProps) => {
    const context = useModalContext()

    return (
        <div className={style.containerModal}>
            <dialog open>
                <div className={style.closeModal}>
                    <img src="./close.png" alt="close" onClick={() => context?.setIsOpen(false)}/>
                </div>
                <div className={style.categoryModal}>
                    {book?.categories.map((e) => (e.name))}
                </div>
                <div className={style.imageModal}>
                    <img src={book?.image} alt="image"/>
                </div>
                <div className={style.infos}>
                    <div>
                        <span className={style.idModal}>
                            {" " + book?.id}
                        </span>
                    </div>
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

                </div>
            </dialog>
        </div>
    )

}

export default Modal