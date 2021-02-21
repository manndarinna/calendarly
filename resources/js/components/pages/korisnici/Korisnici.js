import Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import Korisnik from "./Korisnik";

export default class Korisnici extends Component {
    constructor(props) {
        super(props);

        this.state = {
            korisnici: [],
            searchedKorisnici: [],
            controls: ""
        };
        this.fetchKorisnici();
        this.prikaziDropdownSearch = this.prikaziDropdownSearch.bind(this);
        this.searchKorisnik = this.searchKorisnik.bind(this);
        this.delayTimer = Function();
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

    searchKorisnik(e) {
        e.persist();
        this.setState({ [e.target.name]: e.target.value });
        clearTimeout(this.delayTimer);
        this.delayTimer = setTimeout(() => {
            Axios.get(
                "http://127.0.0.1:8000/api/korisnik/search?name=" +
                    e.target.value
            ).then(res => {
                console.log(res.data.korisnici);
                this.setState({
                    searchedKorisnici: res.data.korisnici
                });
            });
        }, 1000);
    }

    prikaziDropdownSearch() {
        return (
            <div>
                <input
                    name="search"
                    list="search"
                    onChange={this.searchKorisnik}
                ></input>
                <a
                    className="btn btn-primary"
                    href={
                        "http://127.0.0.1:8000/korisnik/getByName?name=" +
                        this.state.search
                    }
                >
                    <i class="fas fa-search"></i>
                </a>

                <datalist id="search">
                    {this.state.searchedKorisnici.map(sK => {
                        return <option value={sK.name} />;
                    })}
                </datalist>
            </div>
        );
    }
    render() {
        return [
            this.prikaziDropdownSearch(),
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
