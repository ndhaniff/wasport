import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import ReactQuill,{ Quill } from 'react-quill';
import Datetime from 'react-datetime';
import Dropzone from 'react-dropzone';
import Parser from 'html-react-parser';
import ImageResize from 'quill-image-resize-module';
import { Tabs } from 'antd';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

const MySwal = withReactContent(Swal);
const TabPane = Tabs.TabPane;


Quill.register("modules/imageResize", ImageResize);

export default class EditOfflineForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            details_en : Parser(window.offline.details_en),
            details_ms : Parser(window.offline.details_ms),
            details_zh : Parser(window.offline.details_zh),
            title_en : window.offline.title_en,
            title_ms : window.offline.title_ms,
            title_zh : window.offline.title_zh,
            category : window.offline.category,
            place: window.offline.place,
            state : window.offline.state,
            website : window.offline.website,
            date: window.offline.date,
            fid : window.offline.fid,
            headerImg : window.offline.header,
            toggleDrop: window.offline.toggleDrop,
            raceimg_1 : window.offline.raceimg_1,
            raceimg_2 : window.offline.raceimg_2,
            raceimg_3 : window.offline.raceimg_3,
            raceimg_4 : window.offline.raceimg_4,
            raceimg_5 : window.offline.raceimg_5,
            raceimg_6 : window.offline.raceimg_6,
            toggleDrop_raceimg_1: window.offline.toggleDrop_raceimg_1,
            toggleDrop_raceimg_2: window.offline.toggleDrop_raceimg_2,
            toggleDrop_raceimg_3: window.offline.toggleDrop_raceimg_3,
            toggleDrop_raceimg_4: window.offline.toggleDrop_raceimg_4,
            toggleDrop_raceimg_5: window.offline.toggleDrop_raceimg_5,
            toggleDrop_raceimg_6: window.offline.toggleDrop_raceimg_6,
        }

        /* Quill module */
        this.modules = {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline','strike', 'blockquote'],
                [{'align': null}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                [{ 'color': [] }, { 'background': [] }],
                ['image'],
                ['clean']
            ],
            imageResize: {
            }
        }

        this.handleDetailsEnChange = this.handleDetailsEnChange.bind(this)
        this.handleDetailsMsChange = this.handleDetailsMsChange.bind(this)
        this.handleDetailsZhChange = this.handleDetailsZhChange.bind(this)
        this.handleStateChange = this.handleStateChange.bind(this)
        this.onDrop = this.onDrop.bind(this)
        this.removePreview = this.removePreview.bind(this)
        this.handleInputChange = this.handleInputChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleDate = this.handleDate.bind(this)

        this.onDrop_raceimg_1 = this.onDrop_raceimg_1.bind(this)
        this.onDrop_raceimg_2 = this.onDrop_raceimg_2.bind(this)
        this.onDrop_raceimg_3 = this.onDrop_raceimg_3.bind(this)
        this.onDrop_raceimg_4 = this.onDrop_raceimg_4.bind(this)
        this.onDrop_raceimg_5 = this.onDrop_raceimg_5.bind(this)
        this.onDrop_raceimg_6 = this.onDrop_raceimg_6.bind(this)

        this.removePreview_raceimg_1 = this.removePreview_raceimg_1.bind(this)
        this.removePreview_raceimg_2 = this.removePreview_raceimg_2.bind(this)
        this.removePreview_raceimg_3 = this.removePreview_raceimg_3.bind(this)
        this.removePreview_raceimg_4 = this.removePreview_raceimg_4.bind(this)
        this.removePreview_raceimg_5 = this.removePreview_raceimg_5.bind(this)
        this.removePreview_raceimg_6 = this.removePreview_raceimg_6.bind(this)
    }

    handleSubmit(e){
        e.preventDefault()

        let {details_en,details_ms,details_zh,title_en,title_ms,title_zh,category,place,state,date,website,headerImg,raceimg_1,raceimg_2,raceimg_3,raceimg_4,raceimg_5,raceimg_6,fid} = this.state
        let{toggleDrop}  = this.state

        let data = new FormData;

        data.append('details_en', details_en)
        data.append('details_ms', details_ms)
        data.append('details_zh', details_zh)
        data.append('title_en', title_en)
        data.append('title_ms', title_ms)
        data.append('title_zh', title_zh)
        data.append('category', category)
        data.append('place', place)
        data.append('state', state)
        data.append('website', website)
        data.append('date', date)
        data.append('headerImg', headerImg[0])
        data.append('raceimg_1', raceimg_1[0])
        data.append('raceimg_2', raceimg_2[0])
        data.append('raceimg_3', raceimg_3[0])
        data.append('raceimg_4', raceimg_4[0])
        data.append('raceimg_5', raceimg_5[0])
        data.append('raceimg_6', raceimg_6[0])
        data.append('fid', fid)

        let message = [];
        let messageF = '';
        let race_img = [];

        if(toggleDrop) { message.push('Banner') }
        if(title_ms === '') { message.push('Title(MS)') }
        if(title_zh === '') { message.push('Title(ZH)') }
        if(details_en.length == 0) { message.push('Details(EN)') }
        if(details_ms.length == 0) { message.push('Details(MS)') }
        if(details_zh.length == 0) { message.push('Details(ZH)') }

        if(typeof raceimg_1[0] != 'undefined') { race_img.push(raceimg_1[0])}
        if(typeof raceimg_2[0] != 'undefined') { race_img.push(raceimg_2[0])}
        if(typeof raceimg_3[0] != 'undefined') { race_img.push(raceimg_3[0])}
        if(typeof raceimg_4[0] != 'undefined') { race_img.push(raceimg_4[0])}
        if(typeof raceimg_5[0] != 'undefined') { race_img.push(raceimg_5[0])}
        if(typeof raceimg_6[0] != 'undefined') { race_img.push(raceimg_6[0])}
        if(race_img.length == 0) {message.push('Race Image')}

        messageF = message.join(', ')

        if(message.length != 0) {

          MySwal.fire({
            title: 'These fields are empty',
            text: messageF,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Update race anyway',
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#d33'
          }).then((result) => {
            if (result.value) {

              axios.post('/admin/offlines/edit',data).then((res) => {
                  if(res.data.success){

                      MySwal.fire({
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        type: 'success',
                        title: 'Race updated'
                      })

                      window.setTimeout(function(){
                        location.href = location.origin + '/admin/offlines/edit/'+res.data.fid
                      } ,3000);

                  } else {
                      alert('something wrong')
                  }
              }) .catch((error) => {
                  // Error
                  if (error.response) {
                      // The request was made and the server responded with a status code
                      // that falls out of the range of 2xx
                      console.log(error.response.data);
                      console.log(error.response.status);
                      console.log(error.response.headers);
                  } else if (error.request) {
                      // The request was made but no response was received
                      // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                      // http.ClientRequest in node.js
                      console.log(error.request);
                  } else {
                      // Something happened in setting up the request that triggered an Error
                      console.log('Error', error.message);
                  }
                  console.log(error.config);
              });

            }
          })

        } else {

          axios.post('/admin/offlines/edit',data).then((res) => {
              if(res.data.success){

                  MySwal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    type: 'success',
                    title: 'Race updated'
                  })

                  window.setTimeout(function(){
                    location.href = location.origin + '/admin/offlines/edit/'+res.data.fid
                  } ,3000);

              } else {
                  alert('something wrong')
              }
          }) .catch((error) => {
              // Error
              if (error.response) {
                  // The request was made and the server responded with a status code
                  // that falls out of the range of 2xx
                  console.log(error.response.data);
                  console.log(error.response.status);
                  console.log(error.response.headers);
              } else if (error.request) {
                  // The request was made but no response was received
                  // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                  // http.ClientRequest in node.js
                  console.log(error.request);
              } else {
                  // Something happened in setting up the request that triggered an Error
                  console.log('Error', error.message);
              }
              console.log(error.config);
          });

        }

    }

    handleDetailsEnChange(data){
        this.setState({ details_en: data })
    }
    handleDetailsMsChange(data){
        this.setState({ details_ms: data })
    }
    handleDetailsZhChange(data){
        this.setState({ details_zh: data })
    }

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    handleStateChange(event) {
      this.setState({state: event.target.value});
    }

    handleDate(date){
        this.setState({
            date: date.format('YYYY-MM-DD')
        })
    }

    onDrop(acceptedFiles, rejectedFiles) {
        this.setState({headerImg: acceptedFiles,toggleDrop:false})
    }

    removePreview(){
        this.setState({headerImg : [],toggleDrop:true})
    }

    onDrop_raceimg_1(acceptedFiles, rejectedFiles) {
        this.setState({raceimg_1: acceptedFiles,toggleDrop_raceimg_1:false,show_raceimg_2:true})
    }

    onDrop_raceimg_2(acceptedFiles, rejectedFiles) {
        this.setState({raceimg_2: acceptedFiles,toggleDrop_raceimg_2:false,show_raceimg_3:true})
    }

    onDrop_raceimg_3(acceptedFiles, rejectedFiles) {
        this.setState({raceimg_3: acceptedFiles,toggleDrop_raceimg_3:false,show_raceimg_4:true})
    }

    onDrop_raceimg_4(acceptedFiles, rejectedFiles) {
        this.setState({raceimg_4: acceptedFiles,toggleDrop_raceimg_4:false,show_raceimg_5:true})
    }

    onDrop_raceimg_5(acceptedFiles, rejectedFiles) {
        this.setState({raceimg_5: acceptedFiles,toggleDrop_raceimg_5:false,show_raceimg_6:true})
    }

    onDrop_raceimg_6(acceptedFiles, rejectedFiles) {
        this.setState({raceimg_6: acceptedFiles,toggleDrop_raceimg_6:false})
    }

    removePreview_raceimg_1(){
        this.setState({raceimg_1: [],toggleDrop_raceimg_1:true})
    }

    removePreview_raceimg_2(){
        this.setState({raceimg_2: [],toggleDrop_raceimg_2:true})
    }

    removePreview_raceimg_3(){
        this.setState({raceimg_3: [],toggleDrop_raceimg_3:true})
    }

    removePreview_raceimg_4(){
        this.setState({raceimg_4: [],toggleDrop_raceimg_4:true})
    }

    removePreview_raceimg_5(){
        this.setState({raceimg_5: [],toggleDrop_raceimg_5:true})
    }

    removePreview_raceimg_6(){
        this.setState({raceimg_6: [],toggleDrop_raceimg_6:true})
    }

    render() {
        if(this.state.headerImg.length != 0){
            var previewImg =  <div className="mb-2 text-center"><button onClick={this.removePreview} className="btn btn-danger float-right">X</button><br/><img height="300px" src= {(this.state.headerImg[0].preview)} alt=""/></div>
        } else {
            var previewImg =  <img src="" alt=""/>
        }

        if(this.state.toggleDrop){
            var dropzone =
         <Dropzone
            style={{
                "width": "100%",
                "border": "1px dashed",
                "padding": "5%",}}
            accept="image/jpeg, image/png"
            onDrop={this.onDrop}
            multiple={false}
            name="headerImg">
            <div className="text-center">
            <p>Try dropping some files here, or click to select files to upload.</p>
            <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
        </Dropzone>
        } else {
            var dropzone = ""
        }

        //raceimg 1
        if(this.state.raceimg_1.length != 0){
            var previewImg_raceimg_1 =  <div className="mb-2 text-center"><button onClick={this.removePreview_raceimg_1} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.raceimg_1[0].preview} alt=""/></div>
        } else { var previewImg_raceimg_1 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_raceimg_1){
            var dropzone_raceimg_1 =
              <Dropzone
                className="dropzone-style"
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_raceimg_1}
                multiple={false}
                name="raceimg_1">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
        } else { var dropzone_raceimg_1 = "" }

        //raceimg 2
        if(this.state.raceimg_2.length != 0){
            var previewImg_raceimg_2 =  <div className="mb-2 text-center"><button onClick={this.removePreview_raceimg_2} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.raceimg_2[0].preview} alt=""/></div>
        } else { var previewImg_raceimg_2 =  <img src="" alt=""/> }

        if(this.state.toggleDrop_raceimg_2){
            var dropzone_raceimg_2 =
              <Dropzone
                className="dropzone-style"
                accept="image/jpeg, image/png"
                onDrop={this.onDrop_raceimg_2}
                multiple={false}
                name="raceimg_2">
              <div className="text-center">
                <p>Try dropping some files here, or click to select files to upload.</p>
                <p>Only *.jpeg and *.png images will be accepted</p>
              </div>
              </Dropzone>
          } else { var dropzone_raceimg_2 = "" }

          //raceimg 3
          if(this.state.raceimg_3.length != 0){
              var previewImg_raceimg_3 =  <div className="mb-2 text-center"><button onClick={this.removePreview_raceimg_3} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.raceimg_3[0].preview} alt=""/></div>
          } else { var previewImg_raceimg_3 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_raceimg_3){
              var dropzone_raceimg_3 =
                <Dropzone
                  className="dropzone-style"
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_raceimg_3}
                  multiple={false}
                  name="raceimg_3">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_raceimg_3 = "" }

          //raceimg 4
          if(this.state.raceimg_4.length != 0){
              var previewImg_raceimg_4 =  <div className="mb-2 text-center"><button onClick={this.removePreview_raceimg_4} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.raceimg_4[0].preview} alt=""/></div>
          } else { var previewImg_raceimg_4 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_raceimg_4){
              var dropzone_raceimg_4 =
                <Dropzone
                  className="dropzone-style"
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_raceimg_4}
                  multiple={false}
                  name="raceimg_4">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_raceimg_4 = "" }

          //raceimg 5
          if(this.state.raceimg_5.length != 0){
              var previewImg_raceimg_5 =  <div className="mb-2 text-center"><button onClick={this.removePreview_raceimg_5} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.raceimg_5[0].preview} alt=""/></div>
          } else { var previewImg_raceimg_5 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_raceimg_5){
              var dropzone_raceimg_5 =
                <Dropzone
                  className="dropzone-style"
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_raceimg_5}
                  multiple={false}
                  name="raceimg_5">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_raceimg_5 = "" }

          //raceimg 6
          if(this.state.raceimg_6.length != 0){
              var previewImg_raceimg_6 =  <div className="mb-2 text-center"><button onClick={this.removePreview_raceimg_6} className="btn btn-danger float-right">X</button><br/><img className="fit-image" src={this.state.raceimg_6[0].preview} alt=""/></div>
          } else { var previewImg_raceimg_6 =  <img src="" alt=""/> }

          if(this.state.toggleDrop_raceimg_6){
              var dropzone_raceimg_6 =
                <Dropzone
                  className="dropzone-style"
                  accept="image/jpeg, image/png"
                  onDrop={this.onDrop_raceimg_6}
                  multiple={false}
                  name="raceimg_6">
                <div className="text-center">
                  <p>Try dropping some files here, or click to select files to upload.</p>
                  <p>Only *.jpeg and *.png images will be accepted</p>
                </div>
                </Dropzone>
          } else { var dropzone_raceimg_6 = "" }

        return (

            <div className="wrapper p-1">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card">
                            <div className="card-header">Edit Race</div>

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
                                                <input onChange={this.handleInputChange} name="title_en" value={this.state.title_en} className="form-control" type="text" id="racetitle_en" required/>
                                            </TabPane>
                                            <TabPane tab="Ms" key="2">
                                                <label htmlFor="racetitle_ms">Race Title (MS)</label>
                                                <input onChange={this.handleInputChange} name="title_ms" value={this.state.title_ms} className="form-control" type="text" id="racetitle_ms"/>
                                            </TabPane>
                                            <TabPane tab="Zh" key="3">
                                                <label htmlFor="racetitle_zh">Race Title (ZH)</label>
                                                <input onChange={this.handleInputChange} name="title_zh" value={this.state.title_zh} className="form-control" type="text" id="racetitle_zh"/>
                                            </TabPane>
                                        </Tabs>
                                    </div>
                                    <div className="form-row">
                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                          <label>Date<span className="required-field">*</span></label>
                                          <Datetime value={this.state.date} onChange={this.handleDate} timeFormat={false}/>
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                            <label>Category (Eg. 3km, 5km, 10km. Separate with ',')<span className="required-field">*</span></label>
                                            <input onChange={this.handleInputChange} value={this.state.category} name="category" className="form-control" type="text" />
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                            <label>Website</label>
                                            <input onChange={this.handleInputChange} value={this.state.website} name="website" className="form-control" type="text" />
                                        </div>
                                      </div>
                                    </div>

                                    <div className="form-row">
                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                            <label>Location<span className="required-field">*</span></label>
                                            <input onChange={this.handleInputChange} value={this.state.place} name="place" className="form-control" type="text" />
                                        </div>
                                      </div>

                                      <div className="col-sm-12 col-md-4">
                                        <div className="form-group">
                                            <label>State<span className="required-field">*</span></label>
                                            <select value={this.state.state} onChange={this.handleStateChange} style={{'display': 'block'}} className="form-select" required>
                                              <option disabled value=""> -- select an option -- </option>
                                              <option value="Johor">Johor</option>
                                              <option value="Kedah">Kedah</option>
                                              <option value="Kelantan">Kelantan</option>
                                              <option value="Kuala Lumpur">Kuala Lumpur</option>
                                              <option value="Labuan">Labuan</option>
                                              <option value="Melaka">Melaka</option>
                                              <option value="Negeri Sembilan">Negeri Sembilan</option>
                                              <option value="Pahang">Pahang</option>
                                              <option value="Perak">Perak</option>
                                              <option value="Perlis">Perlis</option>
                                              <option value="Pulau Pinang">Pulau Pinang</option>
                                              <option value="Sabah">Sabah</option>
                                              <option value="Sarawak">Sarawak</option>
                                              <option value="Selangor">Selangor</option>
                                              <option value="Terengganu">Terengganu</option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="details">Details (EN)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.details_en} onChange={this.handleDetailsEnChange} required/>
                                            <input type="hidden" name="details_en" value={this.state.details_en}/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="medals">Details (MS)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.details_ms} onChange={this.handleDetailsMsChange} />
                                            <input type="hidden" name="medals_ms" value={this.state.details_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="medals">Details (ZH)</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.details_zh} onChange={this.handleDetailsZhChange} />
                                            <input type="hidden" name="medals_zh" value={this.state.details_zh}/>
                                        </TabPane>
                                        <TabPane tab="Images" key="4">
                                            <div className="row">
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_raceimg_1}
                                                {dropzone_raceimg_1}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_raceimg_2}
                                                {dropzone_raceimg_2}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_raceimg_3}
                                                {dropzone_raceimg_3}
                                              </div>
                                            </div>
                                            <div className="row">
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_raceimg_4}
                                                {dropzone_raceimg_4}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_raceimg_5}
                                                {dropzone_raceimg_5}
                                              </div>
                                              <div className="col-sm-12 col-md-4">
                                                {previewImg_raceimg_6}
                                                {dropzone_raceimg_6}
                                              </div>
                                            </div>
                                        </TabPane>
                                    </Tabs>
                                    </div><br/><br/>
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

if(document.getElementById('editofflineform')){
    ReactDOM.render(<EditOfflineForm />, document.getElementById('editofflineform'))
}
