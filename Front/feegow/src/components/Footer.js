

import 'bootstrap/dist/css/bootstrap.min.css';
import React, { useEffect, useState } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';

import FuncionarioService from './../services/FuncionarioService';

function Footer() {

	const navigate = new useNavigate();
	const location = new useLocation();

	const clickSearch = () => {
		
	}


  return (
    <>
    <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="https://adminkit.io/" target="_blank" class="text-muted"><strong>AdminKit</strong></a> ©
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
    </>
  )
}
export default Footer;
