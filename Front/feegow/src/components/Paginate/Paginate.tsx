
import classnames from 'classnames';

const Paginate = (props: any) => {

    const Label = (e: any) => {

        var retorno = "";
        retorno = e.label;
        if (e.label === '&laquo; Previous') {
            retorno = 'Anterior';
        }
        if (e.label === 'Next &raquo;') {
            retorno = 'Próximo';
        }
        return (
            <>
                {retorno}
            </>
        )
    }

    const handlePaginate = (val: any) => {
        var queryString = val.url.split('?')[1].split('=')[1];
        props.onPaginate(queryString);
    }

    return (
    
    <>
        <ul className="pagination">
            {props.links.length > 0 && props.links.map((val: any, i: any) =>
                <li key={i} className={classnames({ 'page-item': true, 'active': val.active, 'disabled': (val.url == null), 'text': 'align' })}>
                    <a className='page-link' onClick={(e) => handlePaginate(val)} >
                        <Label label={val.label} />
                    </a>
                </li>
            )}
        </ul>
    </>
    
    )
}

export default Paginate;
