<template>
    <div>
        <div class="row">
            <div class="col-3 filters">
                <label>Departure airport (SFO)</label>
                <br>
                <input v-model="departureAirport"/>
            </div>
            <div class="col-3 filters">
                <label>Arrival airport (LAX)</label>
                <br>

                <input v-model="arrivalAirport"/>
            </div>
            <div class="col-3 filters">
                <label>Flight date (2023-03-28)</label>
                <br>
                <input v-model="flightDate"/>
            </div>
            <div class="col-3">
                <br>
                <button
                    @click="fetchData"
                    type="button"
                >
                    Search
                </button>
            </div>
            <div v-if="errors" class=" col-12 error-message">
               <span v-html="errors">
               </span>
            </div>
        </div>
        <table>
            <thead>
            <tr>
                <th>Transporter</th>
                <th>Flight number</th>
                <th>Departure airport</th>
                <th>Arrival airport</th>
                <th>Duration</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="flight in flights.searchResults" :key="flight.flightNumber">
                <td>{{ flight.transporter.name + '(' + flight.transporter.code + ')' }}</td>
                <td>{{ flight.flightNumber }}</td>
                <td>{{ flight.departureDateTime }}</td>
                <td>{{ flight.arrivalDateTime }}</td>
                <td>{{ flight.duration + ' min'}}</td>
            </tr>

            </tbody>
        </table>
        <div ref="form-Flight"></div>
    </div>
</template>

<script>
import axios from 'axios';
export default {

    /**
     * Data of the component.
     */
    data() {
        return {
            flights: [],
            departureAirport: '',
            arrivalAirport: '',
            flightDate: '',
            errors: '',
        };
    },

    /**
     * Methods.
     */
    methods: {
        /**
         * Update flights from Api.
         */
        fetchData() {
            const data = {
                'searchQuery': {
                    'departureAirport': this.departureAirport,
                    'arrivalAirport': this.arrivalAirport,
                    'departureDate': this.flightDate,
                }
            };

            let username = 'admin@admin.com';
            let password = 'password';

            axios.post(
                '/api/search',
                data,
                {auth: {username: username, password: password}}).then((response) => {
                this.flights = response.data;
                this.errors = '';

            }).catch((error) => {
                this.flights = [];
                let er = []
                Object.entries(error.response.data.errors).forEach(([key, err]) => {
                    er += '<br>' + key + ' - ' + err[0]
                })
                this.errors = er;
            });

        },
    },

    /**
     * Watch changes.
     */
    watch: {},
};
</script>
