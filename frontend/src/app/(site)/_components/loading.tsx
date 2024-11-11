
import style from './css/loading.module.css'

const Loading = () => {
    return (
        <div className={style.loading}>
            <img 
                src="/loading.png" 
                alt="Loading..." 
            />
        </div>
    )
}

export default Loading