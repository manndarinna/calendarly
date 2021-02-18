import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class FormaZaKonsultacije extends Component {
    constructor(props) {
        super(props);

        this.state = {};
        this.validacija = this.validacija.bind(this);
    }

    handleChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }

    validacija() {
        if (
            !this.state.naziv ||
            !this.state.datum ||
            !this.state.opis ||
            !this.state.max_pristalica
        )
            return false;

        return true;
    }

    dodajKonsultaciju(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("naziv", this.state.naziv);
        formData.append("datum", this.state.datum);
        formData.append("opis", this.state.opis);
        formData.append("max_pristalica", this.state.max_pristalica);
        if (this.validacija())
            Axios.post(
                "http://127.0.0.1:8000/api/konsultacija/post",
                formData
            ).then(res => {
                alert(res.data.message);
            });
        else alert("Nepravilno uneta polja!");
    }

    render() {
        return (
            <form onSubmit={this.dodajKonsultaciju.bind(this)}>
                <div class="row">
                    <div class="col-6">
                        Naziv:
                        <br></br>
                        <input
                            onChange={this.handleChange.bind(this)}
                            type="text"
                            name="naziv"
                            placeholder="Cas iz matematike"
                            id=""
                            className="form-control"
                        ></input>
                    </div>
                    <div class="col">
                        Datum:
                        <br></br>
                        <input
                            onChange={this.handleChange.bind(this)}
                            col="col"
                            type="datetime-local"
                            name="datum"
                            id=""
                            className="form-control"
                        ></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        Opis:
                        <br></br>
                        <textarea
                            onChange={this.handleChange.bind(this)}
                            type="text"
                            name="opis"
                            placeholder="Kratak opis konsultacije"
                            id=""
                            className="form-control"
                        ></textarea>
                    </div>

                    <div class="col">
                        Maximum pristalica:
                        <br></br>
                        <input
                            onChange={this.handleChange.bind(this)}
                            type="number"
                            min="0"
                            max="59"
                            name="max_pristalica"
                            id=""
                            className="form-control"
                        ></input>
                    </div>
                </div>
                <input
                    class="btn dodaj"
                    type="submit"
                    value="Dodaj konsultacije!"
                ></input>
            </form>
        );
    }
}

if (document.getElementById("formaZaKonsultacije")) {
    ReactDOM.render(
        <FormaZaKonsultacije />,
        document.getElementById("formaZaKonsultacije")
    );
}
