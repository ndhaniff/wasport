import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill, {Quill} from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone'
import ImageResize from 'quill-image-resize-module';
import { Tabs } from 'antd';
import withReactContent from 'sweetalert2-react-content';
import Swal from 'sweetalert2';

const MySwal = withReactContent(Swal);
const TabPane = Tabs.TabPane;

Quill.register("modules/imageResize", ImageResize);

export default class CreateRaceForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            about_en : '',
            about_ms : '',
            about_zh : '',
            awards_en : '',
            awards_ms : '',
            awards_zh : '',
            medals_en : '',
            medals_ms : '',
            medals_zh : '',
            title_en : '',
            title_ms : '',
            title_zh : '',
            price : '',
            category : '',
            engrave : '',
            RaceDateFrom: '',
            RaceDateTo: '',
            RaceDeadlineFrom: '',
            RaceDeadlineTo: '',
            time_from: '',
            time_to: '',
            deadtime_from: '',
            deadtime_to: '',
            headerImg : [],
            toggleDrop: true,
            awardimg_1 : [],
            awardimg_2 : [],
            awardimg_3 : [],
            awardimg_4 : [],
            awardimg_5 : [],
            awardimg_6 : [],
            toggleDrop_awardimg_1: true,
            toggleDrop_awardimg_2: true,
            toggleDrop_awardimg_3: true,
            toggleDrop_awardimg_4: true,
            toggleDrop_awardimg_5: true,
            toggleDrop_awardimg_6: true,
            show_awardimg_2: false,
            show_awardimg_3: false,
            show_awardimg_4: false,
            show_awardimg_5: false,
            show_awardimg_6: false,
            medalimg_1 : [],
            medalimg_2 : [],
            medalimg_3 : [],
            medalimg_4 : [],
            medalimg_5 : [],
            medalimg_6 : [],
            toggleDrop_medalimg_1: true,
            toggleDrop_medalimg_2: true,
            toggleDrop_medalimg_3: true,
            toggleDrop_medalimg_4: true,
            toggleDrop_medalimg_5: true,
            toggleDrop_medalimg_6: true,
            show_medalimg_2: false,
            show_medalimg_3: false,
            show_medalimg_4: false,
            show_medalimg_5: false,
            show_medalimg_6: false,
        }

        /* Quill module */
        this.modules = {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline','strike', 'blockquote'],
                [{'align': null}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                [{ 'color': [] }, { 'background': [] }],
                ['link'],
                ['clean']
            ],
            imageResize: {
            }
        }

        this.handleAboutEnChange = this.handleAboutEnChange.bind(this)
        this.handleAboutMsChange = this.handleAboutMsChange.bind(this)
        this.handleAboutZhChange = this.handleAboutZhChange.bind(this)
        this.handleAwardsEnChange = this.handleAwardsEnChange.bind(this)
        this.handleAwardsMsChange = this.handleAwardsMsChange.bind(this)
        this.handleAwardsZhChange = this.handleAwardsZhChange.bind(this)
        this.handleMedalsEnChange = this.handleMedalsEnChange.bind(this)
        this.handleMedalsMsChange = this.handleMedalsMsChange.bind(this)
        this.handleMedalsZhChange = this.handleMedalsZhChange.bind(this)
        this.onDrop = this.onDrop.bind(this)
        this.removePreview = this.removePreview.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleRaceDatetimeFrom = this.handleRaceDatetimeFrom.bind(this)
        this.handleRaceDatetimeTo = this.handleRaceDatetimeTo.bind(this)
        this.handleRaceDeadlineFrom = this.handleRaceDeadlineFrom.bind(this)
        this.handleRaceDeadlineTo = this.handleRaceDeadlineTo.bind(this)
        this.handleTimeFrom = this.handleTimeFrom.bind(this)
        this.handleTimeTo = this.handleTimeTo.bind(this)
        this.handleDeadTimeFrom = this.handleDeadTimeFrom.bind(this)
        this.handleDeadTimeTo = this.handleDeadTimeTo.bind(this)
        this.handleEngraveChange = this.handleEngraveChange.bind(this)

        this.onDrop_awardimg_1 = this.onDrop_awardimg_1.bind(this)
        this.onDrop_awardimg_2 = this.onDrop_awardimg_2.bind(this)
        this.onDrop_awardimg_3 = this.onDrop_awardimg_3.bind(this)
        this.onDrop_awardimg_4 = this.onDrop_awardimg_4.bind(this)
        this.onDrop_awardimg_5 = this.onDrop_awardimg_5.bind(this)
        this.onDrop_awardimg_6 = this.onDrop_awardimg_6.bind(this)

        this.removePreview_awardimg_1 = this.removePreview_awardimg_1.bind(this)
        this.removePreview_awardimg_2 = this.removePreview_awardimg_2.bind(this)
        this.removePreview_awardimg_3 = this.removePreview_awardimg_3.bind(this)
        this.removePreview_awardimg_4 = this.removePreview_awardimg_4.bind(this)
        this.removePreview_awardimg_5 = this.removePreview_awardimg_5.bind(this)
        this.removePreview_awardimg_6 = this.removePreview_awardimg_6.bind(this)

        this.onDrop_medalimg_1 = this.onDrop_medalimg_1.bind(this)
        this.onDrop_medalimg_2 = this.onDrop_medalimg_2.bind(this)
        this.onDrop_medalimg_3 = this.onDrop_medalimg_3.bind(this)
        this.onDrop_medalimg_4 = this.onDrop_medalimg_4.bind(this)
        this.onDrop_medalimg_5 = this.onDrop_medalimg_5.bind(this)
        this.onDrop_medalimg_6 = this.onDrop_medalimg_6.bind(this)

        this.removePreview_medalimg_1 = this.removePreview_medalimg_1.bind(this)
        this.removePreview_medalimg_2 = this.removePreview_medalimg_2.bind(this)
        this.removePreview_medalimg_3 = this.removePreview_medalimg_3.bind(this)
        this.removePreview_medalimg_4 = this.removePreview_medalimg_4.bind(this)
        this.removePreview_medalimg_5 = this.removePreview_medalimg_5.bind(this)
        this.removePreview_medalimg_6 = this.removePreview_medalimg_6.bind(this)

    }

    handleSubmit(e){
        e.preventDefault()

        let {about_en,about_ms,about_zh,awards_en,awards_ms,awards_zh,title_en,title_ms,title_zh,medals_en,medals_ms,medals_zh,price,category,engrave,RaceDateFrom,RaceDateTo,RaceDeadlineFrom,RaceDeadlineTo,time_from,time_to,deadtime_from,deadtime_to,headerImg,awardimg_1,awardimg_2,awardimg_3,awardimg_4,awardimg_5,awardimg_6,medalimg_1,medalimg_2,medalimg_3,medalimg_4,medalimg_5,medalimg_6} = this.state

        let data = new FormData;

        if(time_from === '') { time_from = '00:00 am' }
        if(time_to === '') { time_to = '00:00 am' }
        if(deadtime_from === '') { deadtime_from = '00:00 am' }
        if(deadtime_to === '') { deadtime_to = '00:00 am' }

        data.append('about_en', about_en)
        data.append('about_ms', about_ms)
        data.append('about_zh', about_zh)
        data.append('awards_en', awards_en)
        data.append('awards_ms', awards_ms)
        data.append('awards_zh', awards_zh)
        data.append('title_en', title_en)
        data.append('title_ms', title_ms)
        data.append('title_zh', title_zh)
        data.append('medals_en', medals_en)
        data.append('medals_ms', medals_ms)
        data.append('medals_zh', medals_zh)
        data.append('price', price)
        data.append('category', category)
        data.append('engrave', engrave)
        data.append('RaceDateFrom', RaceDateFrom)
        data.append('RaceDateTo', RaceDateTo)
        data.append('RaceDeadlineFrom', RaceDeadlineFrom)
        data.append('RaceDeadlineTo', RaceDeadlineTo)
        data.append('time_from', time_from)
        data.append('time_to', time_to)
        data.append('deadtime_from', deadtime_from)
        data.append('deadtime_to', deadtime_to)
        data.append('headerImg', headerImg[0])
        data.append('awardimg_1', awardimg_1[0])
        data.append('awardimg_2', awardimg_2[0])
        data.append('awardimg_3', awardimg_3[0])
        data.append('awardimg_4', awardimg_4[0])
        data.append('awardimg_5', awardimg_5[0])
        data.append('awardimg_6', awardimg_6[0])
        data.append('medalimg_1', medalimg_1[0])
        data.append('medalimg_2', medalimg_2[0])
        data.append('medalimg_3', medalimg_3[0])
        data.append('medalimg_4', medalimg_4[0])
        data.append('medalimg_5', medalimg_5[0])
        data.append('medalimg_6', medalimg_6[0])

        let message = [];
        let messageF = '';
        let award_img = [];
        let medal_img = [];

        if(typeof headerImg[0] == 'undefined') { message.push('Banner') }
        if(title_ms === '') { message.push('Title(MS)') }
        if(title_zh === '') { message.push('Title(ZH)') }
        if(about_ms.length == 0) { message.push('About(MS)') }
        if(about_zh.length == 0) { message.push('About(ZH)') }
        if(medals_ms.length == 0) { message.push('Medal(MS)') }
        if(medals_zh.length == 0) { message.push('Medal(ZH)') }
        if(category === '') { message.push('Category') }

        if(typeof awardimg_1[0] != 'undefined') { award_img.push(awardimg_1[0])}
        if(typeof awardimg_2[0] != 'undefined') { award_img.push(awardimg_2[0])}
        if(typeof awardimg_3[0] != 'undefined') { award_img.push(awardimg_3[0])}
        if(typeof awardimg_4[0] != 'undefined') { award_img.push(awardimg_4[0])}
        if(typeof awardimg_5[0] != 'undefined') { award_img.push(awardimg_5[0])}
        if(typeof awardimg_6[0] != 'undefined') { award_img.push(awardimg_6[0])}
        if(award_img.length == 0) {message.push('Award Image')}

        if(typeof medalimg_1[0] != 'undefined') { medal_img.push(medalimg_1[0])}
        if(typeof medalimg_2[0] != 'undefined') { medal_img.push(medalimg_2[0])}
        if(typeof medalimg_3[0] != 'undefined') { medal_img.push(medalimg_3[0])}
        if(typeof medalimg_4[0] != 'undefined') { medal_img.push(medalimg_4[0])}
        if(typeof medalimg_5[0] != 'undefined') { medal_img.push(medalimg_5[0])}
        if(typeof medalimg_6[0] != 'undefined') { medal_img.push(medalimg_6[0])}
        if(medal_img.length == 0) {message.push('Medal Image')}

        messageF = message.join(', ')

        if(message.length != 0) {

          MySwal.fire({
            title: 'These fields are empty',
            text: messageF,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Create race anyway',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33'
          }).then((result) => {
            if (result.value) {

              axios.post('/admin/races/create',data).then((res) => {
                  if(res.data.success){
                      /*location.href = location.origin + '/admin/races/edit/'+res.data.id
                      alert('Race added')*/

                      MySwal.fire({
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        type: 'success',
                        title: 'Race added'
                      })

                      window.setTimeout(function(){
                        location.href = location.origin + '/admin/races/edit/'+res.data.rid
                      } ,3000);

                  } else {
                      alert('something wrong')
                  }
              })

            }
          })

        } else {

          axios.post('/admin/races/create',data).then((res) => {
              if(res.data.success){
                  /*location.href = location.origin + '/admin/races/edit/'+res.data.id
                  alert('Race added')*/

                  MySwal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    type: 'success',
                    title: 'Race added'
                  })

                  window.setTimeout(function(){
                    location.href = location.origin + '/admin/races/edit/'+res.data.rid
                  } ,3000);

              } else {
                  alert('something wrong')
              }
          })

        }

    }

    handleAboutEnChange(data){
        this.setState({ about_en: data })
    }
    handleAboutMsChange(data){
        this.setState({ about_ms: data })
    }
    handleAboutZhChange(data){
        this.setState({ about_zh: data })
    }

    handleMedalsEnChange(data){
        this.setState({ medals_en: data })
    }
    handleMedalsMsChange(data){
        this.setState({ medals_ms: data })
    }
    handleMedalsZhChange(data){
        this.setState({ medals_zh: data })
    }

    handleAwardsEnChange(data){
        this.setState({ awards_en: data })
    }
    handleAwardsMsChange(data){
        this.setState({ awards_ms: data })
    }
    handleAwardsZhChange(data){
        this.setState({ awards_zh: data })
    }

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    handleRaceDatetimeFrom(date){
        this.setState({
            RaceDateFrom: date.format('YYYY-MM-DD')
        })
    }

    handleRaceDatetimeTo(date){
        this.setState({
            RaceDateTo: date.format('YYYY-MM-DD')
        })
    }

    handleRaceDeadlineFrom(date){
        this.setState({
            RaceDeadlineFrom: date.format('YYYY-MM-DD')
        })
    }

    handleRaceDeadlineTo(date){
        this.setState({
            RaceDeadlineTo: date.format('YYYY-MM-DD')
        })
    }

    handleTimeFrom(date) {
      this.setState({
          time_from: date.format('HH:mm a')
      })
    }

    handleTimeTo(date) {
      this.setState({
          time_to: date.format('HH:mm a')
      })
    }

    handleDeadTimeFrom(date) {
      this.setState({
          deadtime_from: date.format('HH:mm a')
      })
    }

    handleDeadTimeTo(date) {
      this.setState({
          deadtime_to: date.format('HH:mm a')
      })
    }

    handleEngraveChange(event) {
      this.setState({engrave: event.target.value});
    }

    onDrop(acceptedFiles, rejectedFiles) {
        this.setState({headerImg: acceptedFiles,toggleDrop:false})
    }

    removePreview(){
        this.setState({headerImg : [],toggleDrop:true})
    }

    onDrop_awardimg_1(acceptedFiles, rejectedFiles) {
        this.setState({awardimg_1: acceptedFiles,toggleDrop_awardimg_1:false,show_awardimg_2:true})
    }

    onDrop_awardimg_2(acceptedFiles, rejectedFiles) {
        this.setState({awardimg_2: acceptedFiles,toggleDrop_awardimg_2:false,show_awardimg_3:true})
    }

    onDrop_awardimg_3(acceptedFiles, rejectedFiles) {
        this.setState({awardimg_3: acceptedFiles,toggleDrop_awardimg_3:false,show_awardimg_4:true})
    }

    onDrop_awardimg_4(acceptedFiles, rejectedFiles) {
        this.setState({awardimg_4: acceptedFiles,toggleDrop_awardimg_4:false,show_awardimg_5:true})
    }

    onDrop_awardimg_5(acceptedFiles, rejectedFiles) {
        this.setState({awardimg_5: acceptedFiles,toggleDrop_awardimg_5:false,show_awardimg_6:true})
    }

    onDrop_awardimg_6(acceptedFiles, rejectedFiles) {
        this.setState({awardimg_6: acceptedFiles,toggleDrop_awardimg_6:false})
    }

    removePreview_awardimg_1(){
        this.setState({awardimg_1: [],toggleDrop_awardimg_1:true})
    }

    removePreview_awardimg_2(){
        this.setState({awardimg_2: [],toggleDrop_awardimg_2:true})
    }

    removePreview_awardimg_3(){
        this.setState({awardimg_3: [],toggleDrop_awardimg_3:true})
    }

    removePreview_awardimg_4(){
        this.setState({awardimg_4: [],toggleDrop_awardimg_4:true})
    }

    removePreview_awardimg_5(){
        this.setState({awardimg_5: [],toggleDrop_awardimg_5:true})
    }

    removePreview_awardimg_6(){
        this.setState({awardimg_6: [],toggleDrop_awardimg_6:true})
    }

    onDrop_medalimg_1(acceptedFiles, rejectedFiles) {
        this.setState({medalimg_1: acceptedFiles,toggleDrop_medalimg_1:false,show_medalimg_2:true})
    }

    onDrop_medalimg_2(acceptedFiles, rejectedFiles) {
        this.setState({medalimg_2: acceptedFiles,toggleDrop_medalimg_2:false,show_medalimg_3:true})
    }

    onDrop_medalimg_3(acceptedFiles, rejectedFiles) {
        this.setState({medalimg_3: acceptedFiles,toggleDrop_medalimg_3:false,show_medalimg_4:true})
    }

    onDrop_medalimg_4(acceptedFiles, rejectedFiles) {
        this.setState({medalimg_4: acceptedFiles,toggleDrop_medalimg_4:false,show_medalimg_5:true})
    }

    onDrop_medalimg_5(acceptedFiles, rejectedFiles) {
        this.setState({medalimg_5: acceptedFiles,toggleDrop_medalimg_5:false,show_medalimg_6:true})
    }

    onDrop_medalimg_6(acceptedFiles, rejectedFiles) {
        this.setState({medalimg_6: acceptedFiles,toggleDrop_medalimg_6:false})
    }

    removePreview_medalimg_1(){
        this.setState({medalimg_1: [],toggleDrop_medalimg_1:true})
    }

    removePreview_medalimg_1(){
        this.setState({medalimg_1: [],toggleDrop_medalimg_1:true})
    }

    removePreview_medalimg_2(){
        this.setState({medalimg_2: [],toggleDrop_medalimg_2:true})
    }

    removePreview_medalimg_3(){
        this.setState({medalimg_3: [],toggleDrop_medalimg_3:true})
    }

    removePreview_medalimg_4(){
        this.setState({medalimg_4: [],toggleDrop_medalimg_4:true})
    }

    removePreview_medalimg_5(){
        this.setState({medalimg_5: [],toggleDrop_medalimg_5:true})
    }

    removePreview_medalimg_6(){
        this.setState({medalimg_6: [],toggleDrop_medalimg_6:true})
    }

    render() {
        if(this.state.headerImg.length != 0){
            var previewImg =  <div className="mb-2 text-center"><button onClick={this.removePreview} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.headerImg[0].preview} alt=""/></div>
        } else { var previewImg =  <img src="" alt=""/> }

        if(this.state.toggleDrop){
            var dropzone =
         <Dropzone
            style={{
                "width": "100%",
                "border": "1px dashed",
                "padding": "5%",}}
            accept="image/jpeg, image/png"
            onDrop={this.onDrop}
            multiple={true}
            name="headerimg"
        >
            <div className="text-center">
            <p>Try dropping some files here, or click to select files to upload.</p>
            <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
        </Dropzone>
        } else { var dropzone = "" }

        var yesterday = Datetime.moment().subtract( 1, 'day' );
        var dateFrom = (current) => {
            return current.isAfter( yesterday );
        }
        var dateTo = (current) => {
            return current.isAfter( this.state.RaceDateFrom );
        }
        var deadFrom = (current) => {
            return current.isBefore( this.state.RaceDateFrom );
        }

        //awardimg 1
        if(this.state.awardimg_1.length != 0){
            var previewImg_awardimg_1 =  <div className="mb-2 text-center"><button onClick={this.removePreview_awardimg_1} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.awardimg_1[0].preview} alt=""/></div>
        } else { var previewImg_awardimg_1 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_awardimg_1){
            var dropzone_awardimg_1 =
              <Dropzone
                className="dropzone-style"
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_awardimg_1}
                multiple={false}
                name="awardimg_1">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
        } else { var dropzone_awardimg_1 = "" }

        //awardimg 2
        if(this.state.awardimg_2.length != 0){
            var previewImg_awardimg_2 =  <div className="mb-2 text-center"><button onClick={this.removePreview_awardimg_2} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.awardimg_2[0].preview} alt=""/></div>
        } else { var previewImg_awardimg_2 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_awardimg_2){
            var dropzone_awardimg_2 =
              <Dropzone
                className="dropzone-style"
                style={{"display": this.state.show_awardimg_2 ? 'block' : 'none'}}
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_awardimg_2}
                multiple={false}
                name="awardimg_2">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
          } else { var dropzone_awardimg_2 = "" }

          //awardimg 3
          if(this.state.awardimg_3.length != 0){
              var previewImg_awardimg_3 =  <div className="mb-2 text-center"><button onClick={this.removePreview_awardimg_3} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.awardimg_3[0].preview} alt=""/></div>
          } else { var previewImg_awardimg_3 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_awardimg_3){
              var dropzone_awardimg_3 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_awardimg_3 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_awardimg_3}
                  multiple={false}
                  name="awardimg_3">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_awardimg_3 = "" }

          //awardimg 4
          if(this.state.awardimg_4.length != 0){
              var previewImg_awardimg_4 =  <div className="mb-2 text-center"><button onClick={this.removePreview_awardimg_4} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.awardimg_4[0].preview} alt=""/></div>
          } else { var previewImg_awardimg_4 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_awardimg_4){
              var dropzone_awardimg_4 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_awardimg_4 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_awardimg_4}
                  multiple={false}
                  name="awardimg_4">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_awardimg_4 = "" }

          //awardimg 5
          if(this.state.awardimg_5.length != 0){
              var previewImg_awardimg_5 =  <div className="mb-2 text-center"><button onClick={this.removePreview_awardimg_5} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.awardimg_5[0].preview} alt=""/></div>
          } else { var previewImg_awardimg_5 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_awardimg_5){
              var dropzone_awardimg_5 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_awardimg_5 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_awardimg_5}
                  multiple={false}
                  name="awardimg_5">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_awardimg_5 = "" }

          //awardimg 6
          if(this.state.awardimg_6.length != 0){
              var previewImg_awardimg_6 =  <div className="mb-2 text-center"><button onClick={this.removePreview_awardimg_6} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.awardimg_6[0].preview} alt=""/></div>
          } else { var previewImg_awardimg_6 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_awardimg_6){
              var dropzone_awardimg_6 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_awardimg_6 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_awardimg_6}
                  multiple={false}
                  name="awardimg_6">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_awardimg_6 = "" }

          //medalimg 1
          if(this.state.medalimg_1.length != 0){
              var previewImg_medalimg_1 =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalimg_1} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.medalimg_1[0].preview} alt=""/></div>
          } else { var previewImg_medalimg_1 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_medalimg_1){
              var dropzone_medalimg_1 =
                <Dropzone
                  className="dropzone-style"
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_medalimg_1}
                  multiple={false}
                  name="amedalmg_1">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_medalimg_1 = "" }

          //medalimg 2
          if(this.state.medalimg_2.length != 0){
              var previewImg_medalimg_2 =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalimg_2} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.medalimg_2[0].preview} alt=""/></div>
          } else { var previewImg_medalimg_2 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_medalimg_2){
              var dropzone_medalimg_2 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_medalimg_2 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_medalimg_2}
                  multiple={false}
                  name="medalimg_2">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_medalimg_2 = "" }

          //medalimg 3
          if(this.state.medalimg_3.length != 0){
              var previewImg_medalimg_3 =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalimg_3} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.medalimg_3[0].preview} alt=""/></div>
          } else { var previewImg_medalimg_3 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_medalimg_3){
              var dropzone_medalimg_3 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_medalimg_3 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_medalimg_3}
                  multiple={false}
                  name="medalimg_3">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_medalimg_3 = "" }

          //medalimg 4
          if(this.state.medalimg_4.length != 0){
              var previewImg_amedalmg_4 =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalimg_4} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.medalimg_4[0].preview} alt=""/></div>
          } else { var previewImg_medalimg_4 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_medalimg_4){
              var dropzone_medalimg_4 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_medalimg_4 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_medalimg_4}
                  multiple={false}
                  name="medalimg_4">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_medalimg_4 = "" }

          //medalimg 5
          if(this.state.medalimg_5.length != 0){
              var previewImg_medalimg_5 =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalimg_5} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.medalimg_5[0].preview} alt=""/></div>
          } else { var previewImg_medalimg_5 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_medalimg_5){
              var dropzone_medalimg_5 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_awardimg_5 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_medalimg_5}
                  multiple={false}
                  name="medalimg_5">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_medalimg_5 = "" }

          //medalimg 6
          if(this.state.medalimg_6.length != 0){
              var previewImg_medalimg_6 =  <div className="mb-2 text-center"><button onClick={this.removePreview_medalimg_6} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.medalimg_6[0].preview} alt=""/></div>
          } else { var previewImg_medalimg_6 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_medalimg_6){
              var dropzone_medalimg_6 =
                <Dropzone
                  className="dropzone-style"
                  style={{"display": this.state.show_medalimg_6 ? 'block' : 'none'}}
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_medalimg_6}
                  multiple={false}
                  name="medalimg_6">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_medalimg_6 = "" }

        return (

            <div className="wrapper p-1">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">Create Race</div>

                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                    <div className="form-group">
                                    {previewImg}
                                    {dropzone}
                                    </div>
                                    <div className="form-group">
                                        <Tabs defaultActiveKey="1" type="card">
                                            <TabPane tab="En" key="1">
                                                <label htmlFor="racetitle_en">Race Title (EN)<span className="required-field">*</span></label>
                                                <input onChange={this.handleInputChange} name="title_en" className="form-control" type="text" id="racetitle_en" required/>
                                            </TabPane>
                                            <TabPane tab="Ms" key="2">
                                                <label htmlFor="racetitle_ms">Race Title (MS)</label>
                                                <input onChange={this.handleInputChange} name="title_ms" className="form-control" type="text" id="racetitle_ms"/>
                                            </TabPane>
                                            <TabPane tab="Zh" key="3">
                                                <label htmlFor="racetitle_zh">Race Title (ZH)</label>
                                                <input onChange={this.handleInputChange} name="title_zh" className="form-control" type="text" id="racetitle_zh" />
                                            </TabPane>
                                        </Tabs>
                                    </div>
                                    <div className="form-row">
                                    <div className="col-sm-12 col-md-6">
                                      <div className="form-group">
                                        <label htmlFor="price">Race Datetime<span className="required-field">*</span></label>
                                        <div className="form-row">
                                          <div className="col-sm-8 col-md-3">
                                            <Datetime isValidDate={ dateFrom } onChange={this.handleRaceDatetimeFrom} timeFormat={false}/>
                                            <input type="hidden" name="RaceDateFrom" value={this.state.RaceDateFrom}/>
                                          </div>
                                          <div className="col-sm-4 col-md-2">
                                            <Datetime timeFormat="HH:mm a" defaultValue={'00:00 am'} onChange={this.handleTimeFrom} showTimeSelect dateFormat={false} />
                                            <input type="hidden" name="time_from" value={this.state.time_from}/>
                                          </div>
                                          <div className="col-sm-12 col-md-1">
                                            to
                                          </div>
                                          <div className="col-sm-8 col-md-3">
                                            <Datetime isValidDate={ dateTo } onChange={this.handleRaceDatetimeTo} timeFormat={false}/>
                                            <input type="hidden" name="RaceDateTo" value={this.state.RaceDateTo}/>
                                          </div>
                                          <div className="col-sm-4 col-md-2">
                                            <Datetime timeFormat="HH:mm a" defaultValue={'00:00 am'} onChange={this.handleTimeTo} showTimeSelect dateFormat={false} />
                                            <input type="hidden" name="time_to" value={this.state.time_to}/>
                                          </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-12 col-md-6">
                                      <div className="form-group">
                                        <label htmlFor="price">Registration Deadline<span className="required-field">*</span></label>
                                          <div className="form-row">
                                            <div className="col-sm-8 col-md-3">
                                              <Datetime isValidDate={ deadFrom } onChange={this.handleRaceDeadlineFrom} timeFormat={false}/>
                                              <input type="hidden" name="RaceDeadlineFrom" value={this.state.RaceDeadlineFrom}/>
                                            </div>
                                            <div className="col-sm-4 col-md-2">
                                              <Datetime timeFormat="HH:mm a" defaultValue={'00:00 am'} onChange={this.handleDeadTimeFrom} showTimeSelect dateFormat={false} />
                                              <input type="hidden" name="deadtime_from" value={this.state.deadtime_from}/>
                                            </div>
                                            <div className="col-sm-12 col-md-1">
                                              to
                                            </div>
                                            <div className="col-sm-8 col-md-3">
                                            <Datetime isValidDate={ deadFrom } onChange={this.handleRaceDeadlineTo} timeFormat={false}/>
                                            <input type="hidden" name="RaceDeadlineTo" value={this.state.RaceDeadlineTo}/>
                                            </div>
                                            <div className="col-sm-4 col-md-2">
                                              <Datetime timeFormat="HH:mm a" defaultValue={'00:00 am'} onChange={this.handleDeadTimeTo} dateFormat={false} />
                                              <input type="hidden" name="deadtime_to" value={this.state.deadtime_to}/>
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div className="form-row">
                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                            <label>Category (seperate with ',')</label>
                                            <input onChange={this.handleInputChange} name="category" className="form-control" type="text" />
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                            <label>Price<span className="required-field">*</span></label>
                                            <input onChange={this.handleInputChange} name="price" className="form-control" type="text" required/>
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                          <label>Engrave</label>
                                          <select value={this.state.engrave} onChange={this.handleEngraveChange} style={{'display': 'block'}} className="form-select">
                                            <option selected value="no">No</option>
                                            <option value="yes">Yes</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="about">About (EN)<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_en} onChange={this.handleAboutEnChange} />
                                            <input type="hidden" name="about_en" value={this.state.about_en} required/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="about">About (MS)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_ms} onChange={this.handleAboutMsChange} />
                                            <input type="hidden" name="about_ms" value={this.state.about_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="about">About (ZH)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_zh} onChange={this.handleAboutZhChange} />
                                            <input type="hidden" name="about_zh" value={this.state.about_zh}/>
                                        </TabPane>
                                    </Tabs>

                                    </div><br/><br/>
                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="medals">Medals (EN)<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_en} onChange={this.handleMedalsEnChange} />
                                            <input type="hidden" name="medals_en" value={this.state.medals_en} required/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="medals">Medals (MS)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_ms} onChange={this.handleMedalsMsChange} />
                                            <input type="hidden" name="medals_ms" value={this.state.medals_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="medals">Medals (ZH)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_zh} onChange={this.handleMedalsZhChange} />
                                            <input type="hidden" name="medals_zh" value={this.state.medals_zh}/>
                                        </TabPane>
                                        <TabPane tab="Medal Images" key="4">
                                            <div className="row">
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_medalimg_1}
                                                {dropzone_medalimg_1}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_medalimg_2}
                                                {dropzone_medalimg_2}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_medalimg_3}
                                                {dropzone_medalimg_3}
                                              </div>
                                            </div>
                                            <div className="row">
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_medalimg_4}
                                                {dropzone_medalimg_4}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_medalimg_5}
                                                {dropzone_medalimg_5}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_medalimg_6}
                                                {dropzone_medalimg_6}
                                              </div>
                                            </div>
                                        </TabPane>
                                    </Tabs>

                                    </div><br/><br/>
                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="about">Awards (EN)<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_en} onChange={this.handleAwardsEnChange} />
                                            <input type="hidden" name="awards_en" value={this.state.awards_en} required/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="about">Awards (MS)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_ms} onChange={this.handleAwardsMsChange} />
                                            <input type="hidden" name="awards_ms" value={this.state.awards_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="about">Awards (ZH)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_zh} onChange={this.handleAwardsZhChange} />
                                            <input type="hidden" name="awards_zh" value={this.state.awards_zh}/>
                                        </TabPane>
                                        <TabPane tab="Awards Images" key="4">
                                            <div className="row">
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_awardimg_1}
                                                {dropzone_awardimg_1}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_awardimg_2}
                                                {dropzone_awardimg_2}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_awardimg_3}
                                                {dropzone_awardimg_3}
                                              </div>
                                            </div>
                                            <div className="row">
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_awardimg_4}
                                                {dropzone_awardimg_4}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_awardimg_5}
                                                {dropzone_awardimg_5}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_awardimg_6}
                                                {dropzone_awardimg_6}
                                              </div>
                                            </div>
                                        </TabPane>
                                    </Tabs>
                                    </div>
                                    <br/><br/>
                                    <button className="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if(document.getElementById('createraceform')){
    ReactDOM.render(<CreateRaceForm />, document.getElementById('createraceform'))
}
