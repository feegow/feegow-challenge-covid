import 'bootstrap/dist/css/bootstrap.min.css';
import React, { useEffect, useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';

import FuncionarioService from './../services/FuncionarioService';

function Navbar() {

	const navigate = new useNavigate();
	const location = new useLocation();

	const clickSearch = () => {
		
	}


  return (
    <>
     <header className=" d-none d-xs-none d-sm-none d-md-none d-lg-inline-block d-xl-inline-block" style={{ minHeight: "0", width:"100%", minWidth: "0", height:"auto", alignItems: "initial", backgroundColor: "#282c34"}}>
	 <div className='col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none d-xs-none d-sm-none d-md-none d-lg-inline-block d-xl-inline-block'>
			<div className='row container-fluid'>
			<div className='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'/>
				<div className='col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 text-white'>
				<h3 className='m-2 mt-3'>Feegow Clinic</h3> 
				</div>
				<div className='col-12 col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5'>
				<button className="btn btn-primary m-1 mt-3 text-center" type="button" onClick={() => {navigate('/')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-home align-middle me-2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> HOME </button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR FUNCIONARIOS</button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR CADASTRADOS</button>
				</div>		
				
			</div>

		</div>
		<div className='d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none'>
	
				<p className='m-2 mt-2'>Feegow Clinic</p>
				
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/')}}>INICIO</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR COLABORADORES</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR COLABORADORES</button>
			
		</div>
      </header>
     <header className="App-header d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none" style={{ maxHeight: "auto", maxWidth: "auto", minHeight: "auto", width:"100%", minWidth: "auto", height:"auto", padding: '10px 10px 10px 10px ', alignItems: "initial"}}>
      <nav className="navbar navbar-light navbar-bg" >
		
		<div className='col-md-12 col-lg-12 col-xl-12 d-none d-xs-none  d-sm-none d-md-none d-lg-inline-block d-xl-inline-block'>
			<div className='row container-fluid'>
				<div className='col-xs-1 col-sm-1 col-md-1 '/>
				<div className='col-12 col-xs-12 col-sm-12 col-md-2'>
				<p className='m-2 mt-2'>Feegow Clinic</p>
				</div>
				<div className=' col-lg-5 col-xl-5'>
				<button className="btn btn-primary m-1 mt-3 text-center" type="button" onClick={() => {navigate('/')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-home align-middle me-2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> HOME </button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR COLABORADORES</button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR COLABORADORES</button>
				</div>	
				
			</div>
		</div>
		<div className='col-12 col-xs-5 col-sm-12 col-md-5 col-lg-5 col-xl-5d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none'>
	
				<p className='m-2 mt-2'>Feegow Clinic</p>
				
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/')}}>INICIO</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR COLABORADORES</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR COLABORADORES</button>
			
		</div>
		
	  </nav>
      </header>
    </>
  )
}
export default Navbar;
