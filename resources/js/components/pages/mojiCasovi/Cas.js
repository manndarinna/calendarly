import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Cas extends Component {
    constructor(props) {
        super(props);

        this.state = {
            cas: this.props.cas
        };
    }
    deleteCas() {
        Axios.delete(
            "http://127.0.0.1:8000/api/privatan-cas/delete/" + this.state.cas.id
        )
            .then(res => {
                alert(res.data.message);
                this.props.deleteCas(this.state.cas);
            })
            .catch(res => {
                alert(res.data.message);
            });
    }

    render() {
        return (
            <tr>
                <td>{this.state.cas.naziv}</td>
                <td>{this.state.cas.datum}</td>
                <td>
                    {parseInt(this.state.cas.trajanje / 3600) +
                        ":" +
                        (parseInt(this.state.cas.trajanje / 60) % 60)}
                </td>
                <td>
                    {this.state.cas.rezervisao
                        ? this.state.cas.rezervisao.email
                        : "Nije rezervisan "}
                </td>
                <td>
                    {" "}
                    <a
                        className="btn btn-block btn-primary"
                        href={"http://127.0.0.1:8000/cas/" + this.state.cas.id}
                    >
                        <i className="far fa-eye"></i>
                    </a>{" "}
                    <button
                        className="btn btn-block btn-danger"
                        onClick={this.deleteCas.bind(this)}
                    >
                        X
                    </button>{" "}
                </td>
            </tr>
        );
    }
}

if (document.getElementById("cas")) {
    ReactDOM.render(<Cas />, document.getElementById("cas"));
}
