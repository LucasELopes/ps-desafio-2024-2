import style from './css/header.module.css'

const Header = () => {
    return (
        <div className={style.header}>
            <div className={style.headerChild}>
                <div className={style.title}>
                    <a href="/">
                        ShopBook
                    </a>
                </div>
                <div className={style.search}>
                    <input type="text" placeholder='Pesquise o nome do livro'/>
                    <img src="/search-interface-symbol.png" alt="search" />
                </div>
            </div>
        </div>
    )
}

export default Header