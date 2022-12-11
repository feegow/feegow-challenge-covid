import React, { useEffect, useState } from 'react';
import { useLocation } from 'react-router-dom'
import { useNavigate } from "react-router-dom";


const Datatable = (props: any) => {
    const [data, setData] = useState([] as any);
    const [nomecol, setNomeCol] = useState("");
    const location = useLocation();
    /*  */
    let navigate = useNavigate();
    const [links, setLinks] = useState([] as any);

    const Head = () => {
        return (
            <>

                <tr>
                    {props.header.map((nome: any) =>
                        <th key={nome} className="sorting sorting_desc" aria-controls="datatables-reponsive" style={{ minWidth: 240, width: 240 }} aria-label="Name: activate to sort column ascending" aria-sort="descending">
                            {nome === "PRIORIDADE" && props.orders}<b>{nome}</b>
                        </th>)}
                </tr>

            </>)
    }

    const Body = () => {
    return (
     <>
    {props.row}
    </>) }

    return (<><div className='card' style={{ overflow: "auto" }}>
        <div className='card-body'>
            <table className={props.estilo}>
                <thead>
                    {props.title}
                    <Head />
                </thead>
                <tbody style={{ width: 240 }}>
                    <Body />
                </tbody>
            </table>
        </div>
    </div>
        {props.modal1}
        {props.modal2}
        {props.modal3}
    </>)
};


export default Datatable;