import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class FormaZaCas extends Component {
    constructor(props) {
        super(props);

        this.state = {
            prilozeniDokument: null
        };
        this.validacija = this.validacija.bind(this);
    }

    handleChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }
    handleFileUpload(e) {
        console.log(e.target.files[0]);
        this.setState({ [e.target.name]: e.target.files[0] });
    }

    validacija() {
        if (
            !this.state.naziv ||
            !this.state.datum ||
            !this.state.sati ||
            !this.state.minuti
        )
            return false;
        return true;
    }

    dodajCas(e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("naziv", this.state.naziv);
        formData.append("datum", this.state.datum);
        formData.append("sati", this.state.sati);
        formData.append("minuti", this.state.minuti);
        if (this.state.prilozeniDokument != null)
            formData.append("prilozeniDokument", this.state.prilozeniDokument);
        if (this.validacija())
            Axios.post(
                "http://127.0.0.1:8000/api/privatan-cas/post",
                formData,
                {
                    headers: {
                        "content-type": "multipart/form-data"
                    }
                }
            ).then(res => {
                alert(res.data.message);
            });
        else alert("Morate popuniti sva polja!");
    }

    render() {
        return (
            <form onSubmit={this.dodajCas.bind(this)}>
                <div class="row">
                    <div class="col">
                        Naziv:
                        <br></br>
                        <input
                            onChange={this.handleChange.bind(this)}
                            col="col"
                            type="text"
                            name="naziv"
                            placeholder="FormaZaCas iz matematike"
                            id=""
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
                        ></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        Sati:
                        <br></br>
                        <input
                            onChange={this.handleChange.bind(this)}
                            type="number"
                            min="0"
                            max="59"
                            name="sati"
                            id=""
                        ></input>
                    </div>
                    <div class="col-3">
                        Minuti:
                        <br></br>
                        <input
                            onChange={this.handleChange.bind(this)}
                            type="number"
                            min="0"
                            max="59"
                            name="minuti"
                            id=""
                        ></input>
                    </div>
                    <div class="col">
                        Dodajte materijale:
                        <br></br>
                        <input
                            onChange={this.handleFileUpload.bind(this)}
                            type="file"
                            name="prilozeniDokument"
                        ></input>
                    </div>
                </div>
                <br></br>
                <input
                    class="btn dodaj btn-block"
                    type="submit"
                    value="Dodaj Cas!"
                ></input>
            </form>
        );
    }
}

if (document.getElementById("formaZaCas")) {
    ReactDOM.render(<FormaZaCas />, document.getElementById("formaZaCas"));
}
