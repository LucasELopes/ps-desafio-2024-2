import { useEffect, useState } from 'react'
import { useSeachCategoryContext } from '../context/SearchCategoryContext'
import style from './css/header.module.css'

const Header = () => {

    const context = useSeachCategoryContext()
    const [valueInput, setValueInput] = useState('')

    return (
        <div className={style.header}>
            <div className={style.headerChild}>
                <div className={style.title}>
                    <a href="/">
                        ShopBook
                    </a>
                </div>
                <div className={style.search}>
                    <input 
                        type="text" 
                        placeholder='Pesquise o nome do livro'
                        onChange={(e) => setValueInput(e.target.value)}
                        onKeyDown={(e) => e.key === 'Enter' && context?.setIdSearchBook(valueInput)}
                    />
                    <img src="/search-interface-symbol.png" alt="search" onClick={() => context?.setIdSearchBook(valueInput)}/>
                </div>
            </div>
        </div>
    )
}

export default Header