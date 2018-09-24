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
const MS_PER_MINUTE = 60000;

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
        }

        /* Quill module */
        this.modules = {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline','strike', 'blockquote'],
                [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image'],
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
    }

    handleSubmit(e){
        e.preventDefault()

        let {about_en,about_ms,about_zh,awards_en,awards_ms,awards_zh,title_en,title_ms,title_zh,medals_en,medals_ms,medals_zh,price,category,engrave,RaceDateFrom,RaceDateTo,RaceDeadlineFrom,RaceDeadlineTo,time_from,time_to,deadtime_from,deadtime_to,headerImg} = this.state

        let data = new FormData;

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

    render() {
        if(this.state.headerImg.length != 0){
            var previewImg =  <div className="mb-2 text-center"><button onClick={this.removePreview} className="btn btn-danger float-right">X</button><br/><img height="300px" src={this.state.headerImg[0].preview} alt=""/></div>
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
            name="headerimg"
        >
            <div className="text-center">
            <p>Try dropping some files here, or click to select files to upload.</p>
            <p>Only *.jpeg and *.png images will be accepted</p>
            </div>
        </Dropzone>
        } else {
            var dropzone = ""
        }

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
                                                <label htmlFor="racetitle_en">Race Title<span className="required-field">*</span></label>
                                                <input onChange={this.handleInputChange} name="title_en" className="form-control" type="text" id="racetitle_en" required/>
                                            </TabPane>
                                            <TabPane tab="Ms" key="2">
                                                <label htmlFor="racetitle_ms">Race Title</label>
                                                <input onChange={this.handleInputChange} name="title_ms" className="form-control" type="text" id="racetitle_ms"/>
                                            </TabPane>
                                            <TabPane tab="Zh" key="3">
                                                <label htmlFor="racetitle_zh">Race Title</label>
                                                <input onChange={this.handleInputChange} name="title_zh" className="form-control" type="text" id="racetitle_zh" />
                                            </TabPane>
                                        </Tabs>
                                    </div>
                                    <div className="form-row">
                                    <div className="col-sm-6">
                                      <div className="form-group">
                                        <label htmlFor="price">Race Datetime<span className="required-field">*</span></label>
                                        <div className="form-row">
                                          <div className="col-sm-3">
                                            <Datetime isValidDate={ dateFrom } onChange={this.handleRaceDatetimeFrom} timeFormat={false}/>
                                            <input type="hidden" name="RaceDateFrom" value={this.state.RaceDateFrom}/>
                                          </div>
                                          <div className="col-sm-2">
                                            <Datetime timeFormat="HH:mm a" onChange={this.handleTimeFrom} showTimeSelect dateFormat={false} />
                                            <input type="hidden" name="time_from" value={this.state.time_from}/>
                                          </div>
                                          <div className="col-sm-1">
                                            to
                                          </div>
                                          <div className="col-sm-3">
                                            <Datetime isValidDate={ dateTo } onChange={this.handleRaceDatetimeTo} timeFormat={false}/>
                                            <input type="hidden" name="RaceDateTo" value={this.state.RaceDateTo}/>
                                          </div>
                                          <div className="col-sm-2">
                                            <Datetime timeFormat="HH:mm a" onChange={this.handleTimeTo} showTimeSelect dateFormat={false} />
                                            <input type="hidden" name="time_to" value={this.state.time_to}/>
                                          </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                      <div className="form-group">
                                        <label htmlFor="price">Registration Deadline<span className="required-field">*</span></label>
                                          <div className="form-row">
                                            <div className="col-sm-3">
                                              <Datetime isValidDate={ deadFrom } onChange={this.handleRaceDeadlineFrom} timeFormat={false}/>
                                              <input type="hidden" name="RaceDeadlineFrom" value={this.state.RaceDeadlineFrom}/>
                                            </div>
                                            <div className="col-sm-2">
                                              <Datetime timeFormat="HH:mm a" onChange={this.handleDeadTimeFrom} showTimeSelect dateFormat={false} />
                                              <input type="hidden" name="deadtime_from" value={this.state.deadtime_from}/>
                                            </div>
                                            <div className="col-sm-1">
                                              to
                                            </div>
                                            <div className="col-sm-3">
                                            <Datetime isValidDate={ deadFrom } onChange={this.handleRaceDeadlineTo} timeFormat={false}/>
                                            <input type="hidden" name="RaceDeadlineTo" value={this.state.RaceDeadlineTo}/>
                                            </div>
                                            <div className="col-sm-2">
                                              <Datetime timeFormat="HH:mm a" onChange={this.handleDeadTimeTo} dateFormat={false} />
                                              <input type="hidden" name="deadtime_to" value={this.state.deadtime_to}/>
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div className="form-row">
                                      <div className="col-sm-3">
                                        <div className="form-group">
                                            <label>Category (Seperate with ',')</label>
                                            <input onChange={this.handleInputChange} name="category" className="form-control" type="text" />
                                        </div>
                                      </div>
                                    </div>
                                    <div className="form-row">
                                      <div className="col-sm-3">
                                        <div className="form-group">
                                            <label>Price<span className="required-field">*</span></label>
                                            <input onChange={this.handleInputChange} name="price" className="form-control" type="text" required/>
                                        </div>
                                      </div>
                                    </div>
                                    <div className="form-row">
                                      <div className="col-sm-2">
                                        <div className="form-group">
                                          <label>Engrave</label>
                                          <select value={this.state.engrave} onChange={this.handleEngraveChange} style={{'display': 'block'}}>
                                            <option selected value="no">No</option>
                                            <option value="yes">Yes</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="about">About<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_en} onChange={this.handleAboutEnChange} />
                                            <input type="hidden" name="about_en" value={this.state.about_en} required/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="about">About</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_ms} onChange={this.handleAboutMsChange} />
                                            <input type="hidden" name="about_ms" value={this.state.about_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="about">About</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_zh} onChange={this.handleAboutZhChange} />
                                            <input type="hidden" name="about_zh" value={this.state.about_zh}/>
                                        </TabPane>
                                    </Tabs>

                                    </div><br/><br/>
                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="medals">Medals<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_en} onChange={this.handleMedalsEnChange} />
                                            <input type="hidden" name="medals_en" value={this.state.medals_en} required/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="medals">Medals</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_ms} onChange={this.handleMedalsMsChange} />
                                            <input type="hidden" name="medals_ms" value={this.state.medals_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="medals">Medals</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_zh} onChange={this.handleMedalsZhChange} />
                                            <input type="hidden" name="medals_zh" value={this.state.medals_zh}/>
                                        </TabPane>
                                    </Tabs>

                                    </div><br/><br/>
                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="about">Awards<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_en} onChange={this.handleAwardsEnChange} />
                                            <input type="hidden" name="awards_en" value={this.state.awards_en} required/>
                                        </TabPane>
                                        <TabPane tab="Ms" key="2">
                                            <label htmlFor="about">Awards</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_ms} onChange={this.handleAwardsMsChange} />
                                            <input type="hidden" name="awards_ms" value={this.state.awards_ms}/>
                                        </TabPane>
                                        <TabPane tab="Zh" key="3">
                                            <label htmlFor="about">Awards</label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_zh} onChange={this.handleAwardsZhChange} />
                                            <input type="hidden" name="awards_zh" value={this.state.awards_zh}/>
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
