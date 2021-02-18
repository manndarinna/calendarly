import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Konsultacija extends Component {
    constructor(props) {
        super(props);

        this.state = {
            konsultacija: this.props.konsultacija
        };
    }

    deleteKonsultacija() {
        Axios.delete(
            "http://127.0.0.1:8000/api/konsultacija/delete/" +
                this.state.konsultacija.id
        )
            .then(res => {
                alert(res.data.message);
                this.props.deleteKonsultacija(this.state.konsultacija);
            })
            .catch(res => {
                alert(res.data.message);
            });
    }

    render() {
        return (
            <tr>
                <td>{this.state.konsultacija.naziv}</td>
                <td style={{ wordBreak: "break-all" }}>
                    {this.state.konsultacija.opis}
                </td>
                <td>
                    {this.state.konsultacija.broj_prijava +
                        "/" +
                        this.state.konsultacija.max_prijava}
                </td>
                <td>{this.state.konsultacija.datum}</td>
                <td>
                    {" "}
                    <a
                        className="btn btn-primary btn-block"
                        href={
                            "http://127.0.0.1:8000/konsultacija/" +
                            this.state.konsultacija.id
                        }
                    >
                        <i className="far fa-eye"></i>
                    </a>{" "}
                    <button
                        className="btn btn-block btn-danger"
                        onClick={this.deleteKonsultacija.bind(this)}
                    >
                        X
                    </button>{" "}
                </td>
            </tr>
        );
    }
}

if (document.getElementById("konsultacija")) {
    ReactDOM.render(<Konsultacija />, document.getElementById("konsultacija"));
}
