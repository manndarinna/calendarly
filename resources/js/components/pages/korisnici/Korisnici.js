import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import Korisnik from "./Korisnik";

export default class Korisnici extends Component {
    constructor(props) {
        super(props);

        this.state = {
            korisnici: [],
            controls: ""
        };
        this.fetchKorisnici();
    }

    fetchKorisnici(pageUrl = "http://127.0.0.1:8000/api/korisnik/get?page=1?") {
        Axios.get(pageUrl).then(res => {
            console.log(res.data.korisnici.data);
            this.setState({ korisnici: res.data.korisnici.data });

            this.buildControls(
                res.data.korisnici.prev_page_url,
                res.data.korisnici.next_page_url
            );
        });
    }

    buildControls(prevBtnUrl = null, nextBtnUrl = null) {
        this.setState({
            controls: (
                <div className="d-flex justify-content-center">
                    <button
                        className="btn btn-primary"
                        disabled={prevBtnUrl ? false : true}
                        onClick={() => this.fetchKorisnici(prevBtnUrl)}
                    >
                        Prethodna
                    </button>
                    <button
                        className="btn btn-primary"
                        disabled={nextBtnUrl ? false : true}
                        onClick={() => this.fetchKorisnici(nextBtnUrl)}
                    >
                        Sledeca
                    </button>
                </div>
            )
        });
    }

    render() {
        return [
            <table class="table table-info">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Akcije</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.korisnici.map((k, i) => {
                        return (
                            <Korisnik key={k.id} korisnik={k} redniBr={i + 1} />
                        );
                    })}
                </tbody>
            </table>,
            this.state.controls
        ];
    }
}

if (document.getElementById("korisnici")) {
    ReactDOM.render(<Korisnici />, document.getElementById("korisnici"));
}
