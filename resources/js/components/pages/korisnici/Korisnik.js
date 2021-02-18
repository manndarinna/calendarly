import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Korisnik extends Component {
    constructor(props) {
        super(props);

        this.state = {
            korisnik: this.props.korisnik
        };
    }

    render() {
        return (
            <tr>
                <td>{this.props.redniBr}</td>
                <td>{this.state.korisnik.name}</td>
                <td>{this.state.korisnik.email}</td>
                <td>
                    {" "}
                    <a
                        href={
                            "http://127.0.0.1:8000/korisnik/" +
                            this.state.korisnik.id
                        }
                    >
                        Prikazi detaljno
                    </a>{" "}
                </td>
            </tr>
        );
    }
}

if (document.getElementById("korisnik")) {
    ReactDOM.render(<Korisnik />, document.getElementById("korisnik"));
}
