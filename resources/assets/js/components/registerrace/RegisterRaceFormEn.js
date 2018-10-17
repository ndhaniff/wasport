import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import { Card, Steps } from 'antd';
import StepZilla from 'react-stepzilla'
import Step1 from './steps/Step1'
import Step2 from './steps/Step2'
import Step3 from './steps/Step3'
import Step4 from './steps/Step4'

class RegisterRaceFormEn extends Component {
  constructor(props) {
    super(props);
    this.state = {};

    this.sampleStore = {
      uid : window.user.id,
      firstname: window.user.firstname,
      lastname: window.user.lastname,
      phone: window.user.phone,
      gender: window.user.gender,
      birthday: window.user.birthday,
      add_fl: window.user.add_fl,
      add_sl: window.user.add_sl,
      city: window.user.city,
      state: window.user.state,
      postal: window.user.postal,
      savedToCloud: false,
      rid: window.race.rid,
      title_en: window.race.title_en,
      price: window.race.price,
      category: window.race.category,
      race_category: '',
      engrave: window.race.engrave,
      engrave_name: '',
      addons: window.addons,
      addon_1: '',
      addon_2: '',
      addon_3: '',
      addon_4: '',
      addon_5: '',
      addons_selected: [],
    };
  }

  componentDidMount() {}

  componentWillUnmount() {}

  getStore() {
    return this.sampleStore;
  }

  updateStore(update) {
    this.sampleStore = {
      ...this.sampleStore,
      ...update,
    }
  }

  render() {
    const steps =
    [
      {name: 'Profile', component: <Step1 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
      {name: 'Address', component: <Step2 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
      {name: 'Race', component: <Step3 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
      {name: 'Confirm', component: <Step4 getStore={() => (this.getStore())} updateStore={(u) => {this.updateStore(u)}} />},
    ]

    return (
      <div className='example'>
        <div className='step-progress'>
          <StepZilla
            stepsNavigation={false}
            steps={steps}
            preventEnterSubmission={true}
            nextTextOnFinalActionStep={"Make Payment"}
            hocValidationAppliedTo={[3]}
            //startAtStep={window.sessionStorage.getItem('step') ? parseFloat(window.sessionStorage.getItem('step')) : 0}
            startAtStep={0}
            onStepChange={(step) => window.sessionStorage.setItem('step', step)}
           />
        </div>
      </div>
    )
  }
}

export default RegisterRaceFormEn

if(document.getElementById('registerraceform-en')){
    ReactDOM.render(<RegisterRaceFormEn />, document.getElementById('registerraceform-en'))
}
