import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Konsultacija extends Component {
    constructor(props) {
        super(props);

        this.state = {
            konsultacija: this.props.konsultacija
        };
    }

    render() {
        return (
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    {" "}
                    <a
                        href={
                            "http://127.0.0.1:8000/konsultacija/" +
                            this.state.konsultacija.id
                        }
                    >
                        Prikazi detaljno
                    </a>{" "}
                </td>
            </tr>
        );
    }
}

if (document.getElementById("konsultacija")) {
    ReactDOM.render(<Konsultacija />, document.getElementById("konsultacija"));
}
