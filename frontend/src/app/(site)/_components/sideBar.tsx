import { categoryType } from "@/types/category"
import { useSeachCategoryContext } from "../context/SearchCategoryContext"
import style from "./css/sideBar.module.css"

interface sideBarProps {
    title: string
    categories: categoryType[]
}


const SideBar = ({title, categories}: sideBarProps) => {

    const context = useSeachCategoryContext()

    return (
        <div className={style.sideBar}>
            <div className={style.title}>
                {title}
            </div>
            <div className={style.values}>
                {categories && categories.map((category) => (
                    <button key={category.id} onClick={() => {context?.setIdCategory(category.id)}}>
                            {category.name}
                    </button>
                ))}
            </div>
        </div>
    )
}


export default SideBar