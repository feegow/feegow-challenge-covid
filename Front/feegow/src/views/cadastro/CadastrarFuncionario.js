
import { cpfMask } from '../../utils/utils';

import React, { useEffect, useState } from 'react';

import FuncionarioService from '../../services/FuncionarioService.ts';
import Modals from '../../components/Modal/Modals';
import { useNavigate } from 'react-router-dom';

function CadastrarFuncionario() {
 
	const [modalshow, setModalShow] = useState(false);
	const [erro1, setErro1] = useState(false);
	const [erro2, setErro2] = useState(false);
	const [erro3, setErro3] = useState(false);
	const [erro4, setErro4] = useState(false);
	const [erro5, setErro5] = useState(false);
	const [sucesso, setSucesso] = useState("");
	
	const [id, setId] = useState("");
	const [nome, setNome] = useState("");
	const [cpf, setCpf] = useState("");
	const [dtNascimento, setDtNascimento] = useState("");
	const [comorbidade, setComorbidade] = useState("");

	const [dtPrimeiraDose, setDtPrimeiraDose] = useState("");
	const [nomeDose1, setNomeDose1] = useState("");
	const [lote1, setLote1] = useState("");
	const [dtValidadeDose1, setDtValidadeDose1] = useState("");

	const [dtSegundaDose, setDtSegundaDose] = useState("");
	const [nomeDose2, setNomeDose2] = useState("");
	const [lote2, setLote2] = useState("");
	const [dtValidadeDose2, setDtValidadeDose2] = useState("");

	const [dtTerceiraDose, setDtTerceiraDose] = useState("");
	const [nomeDose3, setNomeDose3] = useState("");
	const [lote3, setLote3] = useState("");
	const [dtValidadeDose3, setDtValidadeDose3] = useState("");

	const navigate = new useNavigate();
	
	useEffect(() => {
		setNome("");
		setCpf("");
		setDtNascimento("");
		setComorbidade("");
		setDtPrimeiraDose("");
		setNomeDose1("");
		setLote1("");
		setDtValidadeDose1("");
		setDtSegundaDose("");
		setNomeDose2("");
		setLote2("");
		setDtValidadeDose2("");
		setDtTerceiraDose("");
		setNomeDose3("");
		setLote3("");
		setDtValidadeDose3("");



	}, []);

	const handleCpf = (e) => {

		setCpf(cpfMask(e))
	}

	const clickVoltar = () => {
		if (sucesso && (!erro3 && !erro4 && !erro5)) {
			setSucesso(false);
			navigate('/');
		}
		else if (erro1) {
			setErro1(false);
			setModalShow(false);
		}
		else if (erro2) {
			setErro2(false);
			setModalShow(false);
		}
		else if (sucesso && (erro3 || erro4 || erro5)){

			navigate('/listar-funcionarios');
		}
	



	}

	const clickCadastrar = () => {

		if (nome !== "" || cpf !== "" || dtNascimento !== "" || comorbidade !== "") {
			FuncionarioService.createFuncionario(nome, cpf, dtNascimento, comorbidade).then((r) => {
				setId(r.id);
				if (r.data.erro) {
					setErro2(true);
					setModalShow(true);
				}
				else {
					if (dtPrimeiraDose !== "" && nomeDose1 !== "" && lote1 !== "" && dtValidadeDose1 !== "") {
						FuncionarioService.createDoseCovid(r.data.id, dtPrimeiraDose, nomeDose1, lote1, dtValidadeDose1).then((response) => {

							
						});
					}
					else {
						setErro3(true);
						

					}
					setSucesso(true);
					setModalShow(true);
				}

			});
		}
		else {
			setErro1(true);
			setModalShow(true);
		}
		if (dtSegundaDose !== "" && nomeDose2 !== "" && lote2 !== "" && dtValidadeDose2 !== "") {
			FuncionarioService.createDoseCovid(id, dtSegundaDose, nomeDose2, lote2, dtValidadeDose2).then((response) => {

				
			});
		}
		else {

			setErro4(true);
	
		}
		if (dtTerceiraDose !== "" && nomeDose3 !== "" && lote3 !== "" && dtValidadeDose3 !== "") {
			FuncionarioService.createDoseCovid(id, dtTerceiraDose, nomeDose3, lote3, dtValidadeDose3).then((response) => {


			});
		}
		else {
			setErro5(true);
			localStorage.setItem("Search", id);
		}
	}

	return (
		<div className="wrapper mb-5 " >
			<div className="main col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-5 text-center" style={{ padding: "13px 13px 13px 13px" }} >
				<h1 className="col-12  mt-4 mb-4 d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none text-white">CADASTRO DE COLABORADORES VACINADOS CONTRA COVID-19</h1>
				<h1 className="col-12 text-center mt-4 mb-4 d-none d-xs-none  d-sm-none d-md-none d-lg-inline-block d-xl-inline-block text-white">CADASTRO DE COLABORADORES VACINADOS CONTRA COVID-19</h1>
				<div className="container" style={{ borderRadius: "20px" }} >
					<div className="div card text-center" style={{ borderRadius: "20px", padding: "13px", margin: 10, display: 'flex', backgroundColor: "#2C3B3F" }}>

						<div className="card-body col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style={{ borderRadius: "20px", padding: "13px", backgroundColor: "#2C3B3F" }}>

							<div className='col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4' />
							<div className="card-body col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style={{ borderRadius: "20px", padding: "13px", display: 'contents' }}>
								<h3 className="form-label text-white mt-2 mb-2">INFORMAÇÕES DO COLABORADOR</h3>
								<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-light" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
										<h5 className="form-label mb-2">NOME COMPLETO</h5>
										<input className="form-control form-control-lg text-center" onChange={(e) => { setNome(e.target.value) }} type="text" name="name" placeholder="Informe o nome completo" />
									</div>
									<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
										<h5 className="form-label mt-2 mb-2">CPF</h5>
										<input className="form-control form-control-lg text-center col-6" maxLength="14" name="cpf" value={cpf} onChange={(e) => handleCpf(e.target.value)} placeholder="Informe seu CPF" />
									</div>
									<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
										<h5 className="form-label mt-2 mb-2">DATA DE NASCIMENTO</h5>
										<input className="form-control form-control-lg text-center col-6" maxLength="10" onChange={(e) => { setDtNascimento(e.target.value) }} type="date" name="dtNascimento" />
									</div>
									<div className="row text-center bg-danger" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '95%' }}>
										<h5 className="form-label text-white mb-2 text-center">PORTADOR DE COMORBIDADE?</h5>
										<div><input type="checkbox" className="form-check-input" onClick={(e) => { setComorbidade(e.target.checked) }} /></div>
									</div>
								</div>

								<h3 className="form-label text-white mt-2 mb-2">TOMOU A PRIMEIRA DOSE?</h3>
								<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-light" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<h5 className="form-label mb-2">DATA DA PRIMEIRA DOSE</h5>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setDtPrimeiraDose(e.target.value) }} type="date" name="dtPrimeira" maxLength="10" />
									<h5 className="form-label mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
									<h6 className="form-label mt-2 mb-2">NOME </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setNomeDose1(e.target.value) }} type="text" name="nomeVacina1" placeholder="Informe o Nome da vacina" />
									<h6 className="form-label mt-2 mb-2">LOTE </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setLote1(e.target.value) }} type="text" name="loteVacina1" placeholder="Informe o Lote da vacina" />
									<h6 className="form-label mt-2 mb-2">DATA VALIDADE </h6>
									<input className="form-control form-control-lg text-center col-6" maxLength="10" onChange={(e) => { setDtValidadeDose1(e.target.value) }} type="date" name="dtVacina1" placeholder="Informe a data de validade da vacina" />
								</div>

								<h3 className="form-label text-white mt-2 mb-2">TOMOU A SEGUNDA DOSE?</h3>
								<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-light" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<h5 className="form-label mb-2">DATA DA SEGUNDA DOSE</h5>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setDtSegundaDose(e.target.value) }} type="date" name="dtSegunda" maxLength="10" />
									<h5 className="form-label mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
									<h6 className="form-label mt-2 mb-2">NOME </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setNomeDose2(e.target.value) }} type="text" name="nomeVacina2" placeholder="Informe o Nome da vacina" />
									<h6 className="form-label mt-2 mb-2">LOTE </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setLote2(e.target.value) }} type="text" name="loteVacina2" placeholder="Informe o Lote da vacina" />
									<h6 className="form-label mt-2 mb-2">DATA VALIDADE </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setDtValidadeDose2(e.target.value) }} type="date" name="dtVacina2" placeholder="Informe a data de validade da vacina" maxLength="10" />
								</div>

								<h3 className="form-label text-white mt-2 mb-2">TOMOU A TERCEIRA DOSE?</h3>
								<div className="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center bg-light" style={{ borderRadius: "20px", padding: "13px 5px", margin: 0, display: 'block', opacity: '85%' }}>
									<h5 className="form-label mb-2">DATA DA TERCEIRA DOSE</h5>
									<input className="form-control form-control-lg text-center" onChange={(e) => { setDtTerceiraDose(e.target.value) }} type="date" name="dtTerceira" maxLength="10" />
									<h5 className="form-label mt-2 mb-2">INFORMAÇÕES DA VACINA APLICADA</h5>
									<h6 className="form-label mt-2 mb-2">NOME </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setNomeDose3(e.target.value) }} type="text" name="nomeVacina3" placeholder="Informe o Nome da vacina" />
									<h6 className="form-label mt-2 mb-2">LOTE </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setLote3(e.target.value) }} type="text" name="loteVacina3" placeholder="Informe o Lote da vacina" />
									<h6 className="form-label mt-2 mb-2">DATA VALIDADE </h6>
									<input className="form-control form-control-lg text-center col-6" onChange={(e) => { setDtValidadeDose3(e.target.value) }} type="date" name="dtVacina3" placeholder="Informe a data de validade da vacina" maxLength="10" />
								</div>

								<div className="text-center mt-3">
									<button className="btn btn-lg btn-primary col-12 mb-5" onClick={() => { clickCadastrar() }}>CADASTRAR</button>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<Modals
				show={modalshow}
				size={"md"}
				title={<p className='m-2 mt-2'>Feegow Clinic</p>}
				text={
					<div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						{sucesso &&
							<div className='alert alert-success text-center' role="alert"><p>Colaborador(a) {nome} cadastrado(a) com Sucesso!!</p></div>
						}
						{erro1 &&
							<div className='alert alert-danger text-center' role="alert"> <p>Campos Obrigatórios</p></div>
						}
						{erro2 &&
							<div className='alert alert-warning text-center' role="alert"><p>Usuario já foi cadastrado!</p></div>
						}
						{erro3 &&
							<div className='alert alert-warning text-center' role="alert"> <p>Vacina 1 não pode ser cadastrada, os campos da vacina 1 são obrigatórios! </p> </div>
						}
						{erro4 &&
							<div className='alert alert-warning text-center' role="alert"><p>Vacina 2 não pode ser cadastrada, os campos da vacina 2 são obrigatórios! </p> </div>
						}
						{erro5 &&
							<div className='alert alert-warning text-center' role="alert"><p>Vacina 3 não pode ser cadastrada, os campos da vacina 3 são obrigatórios! </p> </div>
						}
						{(erro5 || erro3 || erro4) &&
							<small>Você será direcionado para a tela de listagem... </small>
						}
					</div>
				}
				footer={
					<div className="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

						<button className="btn btn-primary btn-xs" onClick={() => { clickVoltar() }}> Voltar </button>

					</div>
				}
			/>
		</div>
	);
}

export default CadastrarFuncionario;
