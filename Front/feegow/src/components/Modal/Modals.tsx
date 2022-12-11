import Modal from 'react-bootstrap/Modal';

function Modals(props: any)
{

    return (
        <>

        {    <Modal
            {...props}
            size={props.size}
            aria-labelledby="contained-modal-title-vcenter"
            fullscreen={ props.fullscreen }
            centered>
                <Modal.Header className="bg-dark">
                    <Modal.Title id="contained-modal-title-vcenter" className="bg-dark text-white">
                        {props.title}
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                        {props.text}
                </Modal.Body>
                <Modal.Footer className="bg-dark text-white">
                    {props.footer}
                </Modal.Footer>

            </Modal>}

        </>
    );
}

export default Modals;