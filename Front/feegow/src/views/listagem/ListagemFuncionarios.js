import Datatable from '../../components/Datatable/Datatable';
import React, { useEffect, useState } from 'react';
import FuncionarioService from '../../services/FuncionarioService.ts';
import Paginate from '../../components/Paginate/Paginate';
import Modals from '../../components/Modal/Modals';
import { formatDate } from '../../utils/utils';

import { cpfMask } from '../../utils/utils';

function ListagemFuncionarios() {

	const [modalshow, setModalShow] = useState(false);
	const [modalshowAlert, setModalshowAlert] = useState(false);
  const [totalColaboradores, setTotalColaboradores] = useState(0);
  const [links, setLinks] = useState([]);
  const [colaboradores, setColaboradores] = useState( [{}] );

	const [search, setSearch] = useState("");
	const [erro3, setErro3] = useState(false);
	const [erro4, setErro4] = useState(false);
	const [erro5, setErro5] = useState(false);
	const [sucesso, setSucesso] = useState(false);
	const [sucesso1, setSucesso1] = useState(false);
	const [sucesso2, setSucesso2] = useState(false);
	const [sucesso3, setSucesso3] = useState(false);
	const [update1, setUpdate1] = useState(false);
	const [update2, setUpdate2] = useState(false);
	const [update3, setUpdate3] = useState(false);

	const [id, setId] = useState("");
	const [nome, setNome] = useState("");
	const [cpf, setCpf] = useState("");
	const [dtNascimento, setDtNascimento] = useState("");
	const [comorbidade, setComorbidade] = useState("");

	const [idPrimeiraDoseCovid, setIdPrimeiraDose] = useState("");
	const [dtPrimeiraDose, setDtPrimeiraDose] = useState("");
	const [nomeDose1, setNomeDose1] = useState("");
	const [lote1, setLote1] = useState("");
	const [dtValidadeDose1, setDtValidadeDose1] = useState("");
  
	const [idSegundaDoseCovid, setIdSegundaDose] = useState("");
	const [dtSegundaDose, setDtSegundaDose] = useState("");
	const [nomeDose2, setNomeDose2] = useState("");
	const [lote2, setLote2] = useState("");
	const [dtValidadeDose2, setDtValidadeDose2] = useState("");
  
	const [idTerceiraDoseCovid, setIdTerceiraDose] = useState("");
	const [dtTerceiraDose, setDtTerceiraDose] = useState("");
	const [nomeDose3, setNomeDose3] = useState("");
	const [lote3, setLote3] = useState("");
	const [dtValidadeDose3, setDtValidadeDose3] = useState("");

  useEffect(() => { 
    setModalShow(false);
    FuncionarioService.findAllColaborador().then((response) => {

      setColaboradores(response.data.data);	
      setTotalColaboradores(response.data.total);	
      setLinks(response.data.links);
    });
    
    }, []);
    
    const clickAlertVoltar = () => {
      setErro3(false);
      setErro4(false);
      setErro5(false);
      setSucesso1(false);
      setSucesso2(false);
      setSucesso3(false);
      setUpdate1(false);
      setUpdate2(false);
      setUpdate3(false);
      setModalshowAlert(false)
    }

    const clickSearch = () => {
      FuncionarioService.findColaboradorAllFilter(search).then((response) =>{
        setColaboradores(response.data.data);	
        setTotalColaboradores(response.data.total);	
        setLinks(response.data.links);
      }
      );
    }
    
    const clickUpdate = () => {

      
      FuncionarioService.updateFuncionario(nome, cpf, dtNascimento, comorbidade, idPrimeiraDoseCovid, idSegundaDoseCovid, idTerceiraDoseCovid).then((response) =>{
      });
      if(idPrimeiraDoseCovid === "" || idPrimeiraDoseCovid === null)
      {
          if (dtPrimeiraDose !== "" && nomeDose1 !== "" && lote1 !== "" && dtValidadeDose1 !== "") {
						FuncionarioService.createDoseCovid(id, dtPrimeiraDose, nomeDose1, lote1, dtValidadeDose1).then((response) => {
             setSucesso1(true);
						});
					}
          else
          {
              setErro3(true);
          }
       
        }
        else
        {
          if (idPrimeiraDoseCovid !== "" && dtPrimeiraDose !== "" && nomeDose1 !== "" && lote1 !== "" && dtValidadeDose1 !== "") {
          FuncionarioService.updateDoseCovid(idPrimeiraDoseCovid, dtPrimeiraDose, nomeDose1, lote1, dtValidadeDose1).then((response) => {
            setUpdate1(true);
          
         });
          }
        }
        if(idSegundaDoseCovid === "" || idSegundaDoseCovid === null)
          {
            if (dtSegundaDose !== "" && nomeDose2 !== "" && lote2 !== "" && dtValidadeDose2 !== "") {
              FuncionarioService.createDoseCovid(id, dtSegundaDose, nomeDose2, lote2, dtValidadeDose2).then((response) => {
                setSucesso2(true);
              
              });
            }
            else {

              setErro4(true);
          
            }
        }
        else
        {
            
          if (dtSegundaDose !== "" && nomeDose2 !== "" && lote2 !== "" && dtValidadeDose2 !== "") {
            FuncionarioService.updateDoseCovid(idSegundaDoseCovid, dtSegundaDose, nomeDose2, lote2, dtValidadeDose2).then((response) => {
              
              setUpdate2(true);
            });
          }
          else {

            setErro4(true);
        
          }
          if(idTerceiraDoseCovid === "" || idTerceiraDoseCovid === null)
          {
            
            if (dtTerceiraDose !== "" && nomeDose3 !== "" && lote3 !== "" && dtValidadeDose3 !== "") {
              FuncionarioService.createDoseCovid(id, dtTerceiraDose, nomeDose3, lote3, dtValidadeDose3).then((response) => {
                setSucesso3(true);

              });
            }
            else {
              setErro5(true);
              
            }
          }
          else
          {
            if (idTerceiraDoseCovid!== "" && dtTerceiraDose !== "" && nomeDose3 !== "" && lote3 !== "" && dtValidadeDose3 !== "") {
              FuncionarioService.updateDoseCovid(idTerceiraDoseCovid, dtTerceiraDose, nomeDose3, lote3, dtValidadeDose3).then((response) => {
                setUpdate3(true);
              
              });
              }
              else{
                setErro5(true);
              }
          }
          
        }
        if(idTerceiraDoseCovid === "" || idTerceiraDoseCovid === null)
        {
          
          if (dtTerceiraDose !== "" && nomeDose3 !== "" && lote3 !== "" && dtValidadeDose3 !== "") {
            FuncionarioService.createDoseCovid(id, dtTerceiraDose, nomeDose3, lote3, dtValidadeDose3).then((response) => {
              setSucesso3(true);

            });
          }
          else {
            setErro5(true);
            
          }
        }
        else
        {
          if (idTerceiraDoseCovid!== "" && dtTerceiraDose !== "" && nomeDose3 !== "" && lote3 !== "" && dtValidadeDose3 !== "") {
            FuncionarioService.updateDoseCovid(idTerceiraDoseCovid, dtTerceiraDose, nomeDose3, lote3, dtValidadeDose3).then((response) => {
              setUpdate3(true);
            
            });
            }
            else{
              setErro5(true);
            }
        }
       
      
      FuncionarioService.findAllColaborador().then((response) => {

        setColaboradores(response.data.data);	
        setTotalColaboradores(response.data.total);	
        setLinks(response.data.links);
      });
      setSucesso(true);
      setModalshowAlert(true);
    }

    const clickVoltar = (e) => {
      FuncionarioService.findAllColaborador().then((response) => {

        setColaboradores(response.data.data);	
        setTotalColaboradores(response.data.total);	
        setLinks(response.data.links);
      });
      setIdPrimeiraDose("");
      setDtPrimeiraDose("");
      setNomeDose1("");
      setLote1("");
      setDtValidadeDose1("");
      setIdSegundaDose("");
      setDtSegundaDose("");
      setNomeDose2("");
      setLote2("");
      setDtValidadeDose2("");
      setIdTerceiraDose("");
      setDtTerceiraDose("");
      setNomeDose3("");
      setLote3("");
      setDtValidadeDose3("");

      setModalShow(false);


    }

    const clickAcessar = (e) => {
  
     
      if(e !== null && e !== undefined)
      {
      FuncionarioService.findColaborador(e).then((response) => {
        setId(e);
                setNome(  response.data[0].nome	);
                setCpf(response.data[0].cpf);
                setDtNascimento(response.data[0].dtNascimento);
                setComorbidade(response.data[0].comorbidade);
                if(response.data[0].idPrimeiraDoseCovid === null || response.data[0].idPrimeiraDoseCovid === "")
                {
                  
                  setIdPrimeiraDose("");
                  setDtPrimeiraDose("");
                  setNomeDose1("");
                  setLote1("");
                  setDtValidadeDose1("");
                }
                else
                {
                  
                  setIdPrimeiraDose(response.data[0].doses_vacina_covid[0].id);
                  setDtPrimeiraDose(response.data[0].doses_vacina_covid[0].dtDoseCovid);
                  setNomeDose1(response.data[0].doses_vacina_covid[0].nome);
                  setLote1(response.data[0].doses_vacina_covid[0].lote);
                  setDtValidadeDose1(response.data[0].doses_vacina_covid[0].dtValidade);


                }
                if(response.data[0].idSegundaDoseCovid === null || response.data[0].idSegundaDoseCovid === "")
                {
               
                  setIdSegundaDose("");
                  setDtSegundaDose("");
                  setNomeDose2("");
                  setLote2("");
                  setDtValidadeDose2("");
                  
                }
                else
                {
                  setIdSegundaDose(response.data[0].doses_vacina_covid[1].id);
                  setDtSegundaDose(response.data[0].doses_vacina_covid[1].dtDoseCovid);
                  setNomeDose2(response.data[0].doses_vacina_covid[1].nome);
                  setLote2(response.data[0].doses_vacina_covid[1].lote);
                  setDtValidadeDose2(response.data[0].doses_vacina_covid[1].dtValidade);
                  
                }
                if(response.data[0].idTerceiraDoseCovid === null || response.data[0].idTerceiraDoseCovid === "")
                {
                  setIdTerceiraDose("");
                  setDtTerceiraDose("");
                  setNomeDose3("");
                  setLote3("");
                  setDtValidadeDose3("");
                }
                else
                {
                  
                  setIdTerceiraDose(response.data[0].doses_vacina_covid[2].id);
                  setDtTerceiraDose(response.data[0].doses_vacina_covid[2].dtDoseCovid);
                  setNomeDose3(response.data[0].doses_vacina_covid[2].nome);
                  setLote3(response.data[0].doses_vacina_covid[2].lote);
                  setDtValidadeDose3(response.data[0].doses_vacina_covid[2].dtValidade);

                }
              });
              
              setModalShow(true);
            }
      
    }

    const handleCpf = (e) => {

      setCpf(cpfMask(e))
    }
  
  
    const handlePaginate = (page) => {
    let f = { page : page};
    FuncionarioService.findAllColaborador(f).then((response) => {
      setColaboradores(response.data.data);	
      setTotalColaboradores(response.data.total);	
      setLinks(response.data.links);
    });
    
    }

    const Trs = () => {

    return (
      <>
       {colaboradores.length > 0 && colaboradores.map((val) => 
       val !== undefined &&
       <tr key={val.id}>
              <td><p>{val.nome}</p></td>
              <td><p>{formatDate(val.dtNascimento)}</p></td>
              <td><p>{val.comorbidade ? "SIM" : "NÃO"}</p></td>
              { val.idPrimeiraDoseCovid !== undefined && val.idPrimeiraDoseCovid !== "" ?
                  <td><p> {val.doses_vacina_covid.length > 0 ? formatDate(val.doses_vacina_covid[0].dtDoseCovid) : "Não Vacinado"} </p></td>
                  :
                  <td>Não foi vacinado!</td>
              }
              { val.idSegundaDoseCovid !== undefined && val.idSegundaDoseCovid !== "" ?
                  <td><p> {val.doses_vacina_covid.length > 1 ? formatDate(val.doses_vacina_covid[1].dtDoseCovid) : "Não Vacinado"}  </p></td>
                  :
                  <td>Não foi vacinado!</td>
              } 
              { val.idTerceiraDoseCovid !== undefined && val.idTerceiraDoseCovid !== "" ?
                  <td><p> {val.doses_vacina_covid.length > 2 ? formatDate(val.doses_vacina_covid[2].dtDoseCovid) : "Não Vacinado"}  </p> </td>
                  :
                  <td>Não foi vacinado!</td>
              }  
              <td><button className='btn btn-md btn-primary' onClick={() => {clickAcessar(val.id)}}>Acessar</button> </td>

        </tr>

        )} 
       
      </>
    );
  }

  return (
    <div className="wrapper" >
      <div className="main mb-5 text-center" >
        <div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
            <h1 className="col-12 mt-4 mb-4 text-white">LISTAGEM DE COLABORADORES</h1>

            <div className="div card text-center text-white" style={{ borderRadius: "20px", padding: "30px 10px 500px", margin: 0, backgroundColor: "#2C3B3F" }}>
            
              {totalColaboradores > 0 ? 
              <h6 className="col-12 mt-2 mb-2 text-start"> {totalColaboradores} COLABORADORES CADASTRADOS </h6>
              :
              <h6 className="col-12 mt-2 mb-2 text-start"> NÃO POSSUI COLABORADORES CADASTRADOS </h6>
            }
        <div className="row col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
							<div className='col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8' />
              <div className='col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2'>
					
						<input type="text" className="form-control mt-3 mb-1" onChange={(e) => {setSearch(e.target.value)}} placeholder="Search…" aria-label="Search"/>

				</div>
				 <div className='col-12 col-xs-12 col-sm-12 col-md-1 col-lg-1 col-xl-1'>
						<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {clickSearch()}}>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
							</button>
				</div>
				</div>
              <div className="card-body col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " style={{ borderRadius: "20px", padding: "13px", backgroundColor: "#2C3B3F" }}>

                <Datatable estilo={"table table-bordered table-hover"}
                  header={['NOME COLABORADOR(A)', 'DATA NASCIMENTO', 'COMORBIDADE', 'DATA PRIMEIRA DOSE', 'DATA SEGUNDA DOSE', 'DATA TERCEIRA DOSE', 'AÇÕES']}
                  row={
                    <Trs />
                  }
                />

              </div>
                  <Paginate className="row d-flex" links={links} onPaginate={(page) => {handlePaginate(page) }} />
            </div>

          </div>
    
        </div>
        <Modals
				show={modalshow}
				size={"xl"}
				title={<p className='m-2 mt-2'>Feegow Clinic</p>}
				text={
					<div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div className="container" style={{ borderRadius: "20px" }} >
					<div className="div card text-center" style={{ borderRadius: "20px", padding: "13px", margin: 10, display: 'flex', backgroundColor: "#2C3B3F" }}>

						<div className="card-body col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style={{ borderRadius: "20px", padding: "13px", backgroundColor: "#2C3B3F" }}>

							<div className='col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4' />
							<div className="card-body col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style={{ borderRadius: "20px", padding: "13px", display: 'contents' }}>
								<h3 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DO COLABORADOR</h3>
								<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-success" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
										<h5 className="form-label text-white mb-2">NOME COMPLETO</h5>
										<input className="form-control form-control-lg text-center" value={nome} onChange={(e) => { setNome(e.target.value) }} type="text" name="name" placeholder="Informe o nome completo" />
									</div>
									<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
										<h5 className="form-label text-white mt-2 mb-2">CPF</h5>
										<input className="form-control form-control-lg text-center col-6" maxLength="14" name="cpf" value={cpf} onChange={(e) => handleCpf(e.target.value)} placeholder="Informe seu CPF" />
									</div>
									<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
										<h5 className="form-label text-white mt-2 mb-2">DATA DE NASCIMENTO</h5>
										<input className="form-control form-control-lg text-center col-6" maxLength="10" value={dtNascimento} onChange={(e) => { setDtNascimento(e.target.value) }} type="date" name="dtNascimento" />
									</div>
									<div className="row text-center bg-danger" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '95%' }}>
										<h5 className="form-label text-white mb-2 text-center">PORTADOR DE COMORBIDADE?</h5>
                    {comorbidade ? 
										<input type="checkbox" className="form-check-input" checked onClick={(e) => { setComorbidade(e.target.checked) }} />
                    :
										<input type="checkbox" className="form-check-input" onClick={(e) => { setComorbidade(e.target.checked) }} />
                  }
									</div>
								</div>

								<h3 className="form-label text-white mt-2 mb-2">TOMOU A PRIMEIRA DOSE?</h3>
								<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-primary"  style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<h5 className="form-label text-white mb-2">DATA DA PRIMEIRA DOSE</h5>
									<input className="form-control form-control-lg text-center col-6" value={dtPrimeiraDose} onChange={(e) => { setDtPrimeiraDose(e.target.value) }} type="date" name="dtPrimeira" maxLength="10" />
									<h5 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
									<h6 className="form-label text-white mt-2 mb-2">NOME </h6>
									<input className="form-control form-control-lg text-center col-6" value={nomeDose1} onChange={(e) => { setNomeDose1(e.target.value) }} type="text" name="nomeVacina1" placeholder="Informe o Nome da vacina" />
									<h6 className="form-label text-white mt-2 mb-2">LOTE </h6>
									<input className="form-control form-control-lg text-center col-6" value={lote1} onChange={(e) => { setLote1(e.target.value) }} type="text" name="loteVacina1" placeholder="Informe o Lote da vacina" />
									<h6 className="form-label text-white mt-2 mb-2">DATA VALIDADE </h6>
									<input className="form-control form-control-lg text-center col-6" value={dtValidadeDose1} maxLength="10" onChange={(e) => { setDtValidadeDose1(e.target.value) }} type="date" name="dtVacina1" placeholder="Informe a data de validade da vacina" />
								</div>
                <h3 className="form-label text-white mt-2 mb-2">TOMOU A SEGUNDA DOSE?</h3>
                <div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-warning" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<h5 className="form-label text-white mb-2">DATA DA SEGUNDA DOSE</h5>
									<input className="form-control form-control-lg text-center col-6" value={dtSegundaDose} onChange={(e) => { setDtSegundaDose(e.target.value) }} type="date" name="dtSegunda" maxLength="10" />
									<h5 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
									<h6 className="form-label text-white mt-2 mb-2">NOME </h6>
									<input className="form-control form-control-lg text-center col-6" value={nomeDose2} onChange={(e) => { setNomeDose2(e.target.value) }} type="text" name="nomeVacina2" placeholder="Informe o Nome da vacina" />
									<h6 className="form-label text-white mt-2 mb-2">LOTE </h6>
									<input className="form-control form-control-lg text-center col-6" value={lote2} onChange={(e) => { setLote2(e.target.value) }} type="text" name="loteVacina2" placeholder="Informe o Lote da vacina" />
									<h6 className="form-label text-white mt-2 mb-2">DATA VALIDADE </h6>
									<input className="form-control form-control-lg text-center col-6" value={dtValidadeDose2} onChange={(e) => { setDtValidadeDose2(e.target.value) }} type="date" name="dtVacina2" placeholder="Informe a data de validade da vacina" maxLength="10" />
								</div>
                
                <h3 className="form-label text-white mt-2 mb-2">TOMOU A TERCEIRA DOSE?</h3>
            
              	<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-info" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<h5 className="form-label text-white mb-2">DATA DA TERCEIRA DOSE</h5>
									<input className="form-control form-control-lg text-center" value={dtTerceiraDose} onChange={(e) => { setDtTerceiraDose(e.target.value) }} type="date" name="dtTerceira" maxLength="10" />
									<h5 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
									<h6 className="form-label text-white mt-2 mb-2">NOME </h6>
									<input className="form-control form-control-lg text-center col-6" value={nomeDose3} onChange={(e) => { setNomeDose3(e.target.value) }} type="text" name="nomeVacina3" placeholder="Informe o Nome da vacina" />
									<h6 className="form-label text-white mt-2 mb-2">LOTE </h6>
									<input className="form-control form-control-lg text-center col-6" value={lote3} onChange={(e) => { setLote3(e.target.value) }} type="text" name="loteVacina3" placeholder="Informe o Lote da vacina" />
									<h6 className="form-label text-white mt-2 mb-2">DATA VALIDADE </h6>
									<input className="form-control form-control-lg text-center col-6" value={dtValidadeDose3} onChange={(e) => { setDtValidadeDose3(e.target.value) }} type="date" name="dtVacina3" placeholder="Informe a data de validade da vacina" maxLength="10" />
								</div>
                
                
							

							</div>
						</div>
					</div>
				</div>
					</div>
				}
				footer={
					<div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <div className="text-center mt-3">
									<button className="btn btn-lg btn-primary col-12 mb-2" onClick={() => { clickUpdate() }}>SALVAR</button>
						      <button className="btn btn-danger btn-xs col-12 mb-5" onClick={ () => { clickVoltar() }}> VOLTAR </button>

								</div>
					</div>
				}
			/>
      <Modals
				show={modalshowAlert}
				size={"md"}
				title={<p className='m-2 mt-2'>Feegow Clinic</p>}
				text={
					<div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						{sucesso &&
							<div className='alert alert-success text-center' role="alert"><p>Colaborador(a) {nome} atualizado(a) com Sucesso!!</p></div>
						}
						{erro3 && 
							<div className='alert alert-warning text-center' role="alert"> <p>Eai, já tomou a Vacina 1? Todos os campos da vacina 1 são de preenchimento obrigatórios! </p> </div>
						}
						{erro4 && (idPrimeiraDoseCovid === null || idPrimeiraDoseCovid === undefined) &&
							<div className='alert alert-warning text-center' role="alert"><p>Opa, e a 2 dose da Vacina? Todos os campos da vacina 2 são de preenchimento obrigatórios! </p> </div>
						}
						{erro5 && (idSegundaDoseCovid === null || idSegundaDoseCovid === undefined) &&
							<div className='alert alert-warning text-center' role="alert"><p>Oi, e a 2 dose da Vacina? Todos os campos da vacina 3 são de preenchimento obrigatórios! </p> </div>
						}
						{sucesso1 && 
							<div className='alert alert-warning text-center' role="alert"> <p>Vacina 1 inserida com sucesso!! </p> </div>
						}
						{sucesso2 &&
							<div className='alert alert-warning text-center' role="alert"><p>Vacina 2 inserida com sucesso!! </p> </div>
						}
						{sucesso3 &&
							<div className='alert alert-warning text-center' role="alert"><p>Vacina 3 inserida com sucesso!! </p> </div>
						}
            {update1 && 
							<div className='alert alert-warning text-center' role="alert"> <p>Vacina 1 atualizada com sucesso!! </p> </div>
						}
						{update2 &&
							<div className='alert alert-warning text-center' role="alert"><p>Vacina 2 atualizada com sucesso!! </p> </div>
						}
						{update3 &&
							<div className='alert alert-warning text-center' role="alert"><p>Vacina 3 atualizada com sucesso!! </p> </div>
						}
					
					</div>
				}
				footer={
					<div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

						<button className="btn btn-primary btn-xs" onClick={() => { clickAlertVoltar() }}> Voltar </button>

					</div>
				}
			/>
      </div>
      );
}

      export default ListagemFuncionarios;
