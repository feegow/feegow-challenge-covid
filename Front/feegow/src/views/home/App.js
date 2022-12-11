
import './App.css';
import Carousel from 'react-bootstrap/Carousel';

function App() {
  return (
     <div className="row bg-dark" style={{ backgroundColor: "#282c34" }}>
     <div className="container bg-dark col-12" style={{ backgroundColor: "#282c34" }}>
   
     <div id="carouselExampleIndicators" className="carousel slide bg-dark" data-bs-ride="carousel" style={{ backgroundColor: "#282c34" }}>
     <Carousel>
      <Carousel.Item>
        <img
          className="col-12"
          src="./1.png"
          alt="First slide"
        />
        <Carousel.Caption>
         
        </Carousel.Caption>
      </Carousel.Item>
      <Carousel.Item>
        <img
          className="col-12"
          src="2.png"
          alt="Second slide"
        />

        <Carousel.Caption>
      
        </Carousel.Caption>
      </Carousel.Item>
      <Carousel.Item>
        <img
          className="col-12"
          src="3.png"
          alt="Third slide"
        />

        <Carousel.Caption>
   
        </Carousel.Caption>
      </Carousel.Item>
    </Carousel>

</div>
<div className="row bg-dark mt-5 mb-5">
								<div className="col-md-5 col-sm-6 ms-auto mt-2 mb-2">
									<div className="card" style={{  backgroundColor: "#2C3B3F" }}>
										<div className="card-body text-white" >
											<h5 className="h6 card-title">Do I need a credit card to sign up?</h5>
											<p className="mb-0">Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
												adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
										</div>
									</div>
								</div>
								<div className="col-md-5 col-sm-6 me-auto mt-2 mb-2">
									<div className="card" style={{  backgroundColor: "#2C3B3F" }}>
										<div className="card-body text-white">
											<h5 className="h6 card-title">Do you offer a free trial?</h5>
											<p className="mb-0">Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
												adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
										</div>
									</div>
								</div>
								<div className="col-md-5 col-sm-6 ms-auto mt-2 mb-2">
									<div className="card" style={{  backgroundColor: "#2C3B3F" }}>
										<div className="card-body text-white">
											<h5 className="h6 card-title">What if I decide to cancel my plan?</h5>
											<p className="mb-0">Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
												adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
										</div>
									</div>
								</div>
								<div className="col-md-5 col-sm-6 me-auto mt-2 mb-2">
									<div className="card" style={{  backgroundColor: "#2C3B3F" }}>
										<div className="card-body text-white">
											<h5 className="h6 card-title">Can I cancel at anytime?</h5>
											<p className="mb-0">Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet
												adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
										</div>
									</div>
								</div>
							</div>
    </div> 
    </div> 
  );
}

export default App;
