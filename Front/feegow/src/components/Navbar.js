import 'bootstrap/dist/css/bootstrap.min.css';

import { useNavigate } from 'react-router-dom';

function Navbar() {

	const navigate = new useNavigate();
  return (
    <>
     <header className="App-header d-none d-xs-none d-sm-none d-md-none d-lg-inline-block d-xl-inline-block" style={{ minHeight: "auto", width:"100%", minWidth: "auto", height:"auto", alignItems: "initial"}}>
	 <div className='col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none d-xs-none  d-sm-none d-md-none d-lg-inline-block d-xl-inline-block'>
			<div className='row container-fluid'>
				<div className='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'/>
				<div className='col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2'>
				<p className='m-2 mt-2'>Feegow Clinic</p>
				</div>
				<div className='col-12 col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5'>
				<button className="btn btn-primary m-1 mt-3 text-center" type="button" onClick={() => {navigate('/')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-home align-middle me-2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> HOME </button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR FUNCIONARIOS</button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR CADASTRADOS</button>
				</div>		
				<div className='col-12 col-xs-2 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
						<input type="text" className="form-control mt-3 mb-1" placeholder="Search…" aria-label="Search"/>

				</div>
				<div className='col-12 col-xs-12 col-sm-1 col-md-1 col-lg-1 col-xl-1'>
						<button className="btn btn-primary m-1 mt-3" type="button">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
							</button>
				</div>
			</div>

		</div>
		<div className='d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none'>
	
				<p className='m-2 mt-2'>Feegow Clinic</p>
				
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/')}}>INICIO</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR FUNCIONARIOS</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR CADASTRADOS</button>
			
		</div>
      </header>
     <header className="App-header container d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none" style={{ minHeight: "auto", width:"100%", minWidth: "auto", height:"auto", alignItems: "initial"}}>
      <nav className="navbar navbar-light navbar-bg" >
		
		<div className='col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none d-xs-none  d-sm-none d-md-none d-lg-inline-block d-xl-inline-block'>
			<div className='row container-fluid'>
				<div className='col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1'/>
				<div className='col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2'>
				<p className='m-2 mt-2'>Feegow Clinic</p>
				</div>
				<div className='col-12 col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5'>
				<button className="btn btn-primary m-1 mt-3 text-center" type="button" onClick={() => {navigate('/')}}><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-home align-middle me-2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> HOME </button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR FUNCIONARIOS</button>
				<button className="btn btn-primary m-1 mt-3" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR CADASTRADOS</button>
				</div>		
				<div className='col-12 col-xs-2 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
						<input type="text" className="form-control mt-3 mb-1" placeholder="Search…" aria-label="Search"/>

				</div>
				<div className='col-12 col-xs-12 col-sm-1 col-md-1 col-lg-1 col-xl-1'>
						<button className="btn btn-primary m-1 mt-3" type="button">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
							</button>
				</div>
			</div>
		</div>
		<div className='d-inline-block d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none'>
	
				<p className='m-2 mt-2'>Feegow Clinic</p>
				
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/')}}>INICIO</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/cadastrar-funcionario')}}>CADASTRAR FUNCIONARIOS</button>
				<button className="btn btn-primary m-1 mt-3 col-12" type="button" onClick={() => {navigate('/listar-funcionarios')}}>LISTAR CADASTRADOS</button>
			
		</div>
		<div className='col-12 col-xs-2 col-sm-3 col-md-3 col-lg-3 col-xl-3'>
						<input type="text" className="form-control mt-3 mb-1" placeholder="Search…" aria-label="Search"/>

				</div>
				<div className='col-12 col-xs-12 col-sm-1 col-md-1 col-lg-1 col-xl-1'>
						<button className="btn btn-primary m-1 mt-3" type="button">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
							</button>
				</div>
	  </nav>
      </header>
    </>
  )
}
export default Navbar;
