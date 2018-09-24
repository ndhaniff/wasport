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

export default class EditRaceForm extends Component {

    constructor(props){
        super(props)
        this.state = {
            about_en : Parser(window.race.about_en),
            about_ms : Parser(window.race.about_ms),
            about_zh : Parser(window.race.about_zh),
            awards_en : Parser(window.race.awards_en),
            awards_ms : Parser(window.race.awards_ms),
            awards_zh : Parser(window.race.awards_zh),
            medals_en : Parser(window.race.medals_en),
            medals_ms : Parser(window.race.medals_ms),
            medals_zh : Parser(window.race.medals_zh),
            title_en : window.race.title_en,
            title_ms : window.race.title_ms,
            title_zh : window.race.title_zh,
            price : window.race.price,
            category : window.race.category,
            engrave : window.race.engrave,
            RaceDateFrom: new Date(window.race.date_from),
            RaceDateTo: new Date(window.race.date_to),
            RaceDeadlineFrom:new Date(window.race.dead_from),
            RaceDeadlineTo:new Date(window.race.dead_to),
            headerImg : [{preview : window.race.header}],
            rid : window.race.rid,
            toggleDrop: false,
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
        this.handleEngraveChange = this.handleEngraveChange.bind(this)
    }

    handleSubmit(e){
        e.preventDefault()

        let {about_en,about_ms,about_zh,awards_en,awards_ms,awards_zh,medals_en,medals_ms,medals_zh,title_en,title_ms,title_zh,price,category,engrave,RaceDateFrom,RaceDateTo,RaceDeadlineFrom,RaceDeadlineTo,headerImg,rid} = this.state

        let data = new FormData;

        data.append('about_en', about_en)
        data.append('about_ms', about_ms)
        data.append('about_zh', about_zh)
        data.append('awards_en', awards_en)
        data.append('awards_ms', awards_ms)
        data.append('awards_zh', awards_zh)
        data.append('medals_en', medals_en)
        data.append('medals_ms', medals_ms)
        data.append('medals_zh', medals_zh)
        data.append('title_en', title_en)
        data.append('title_ms', title_ms)
        data.append('title_zh', title_zh)
        data.append('price', price)
        data.append('category', category)
        data.append('engrave', engrave)
        data.append('RaceDateFrom', Datetime.moment(RaceDateFrom).format('DD MMM YYYY (HH:mm a)'))
        data.append('RaceDateTo', Datetime.moment(RaceDateTo).format('DD MMM YYYY (HH:mm a)'))
        data.append('RaceDeadlineFrom', Datetime.moment(RaceDeadlineFrom).format('DD MMM YYYY (HH:mm a)'))
        data.append('RaceDeadlineTo', Datetime.moment(RaceDeadlineTo).format('DD MMM YYYY (HH:mm a)'))
        data.append('headerImg', headerImg[0])
        data.append('rid', rid)

        axios.post('/admin/races/edit',data).then((res) => {
            if(res.data.success){
                /*location.href = location.origin + '/admin/races/edit/'+res.data.id
                alert('Race updated')*/

                MySwal.fire({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  type: 'success',
                  title: 'Race updated'
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

    handleAwardsEnChange(data){
        this.setState({ awards_en: data })
    }
    handleAwardsMsChange(data){
        this.setState({ awards_ms: data })
    }
    handleAwardsZhChange(data){
        this.setState({ awards_zh: data })
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

    handleInputChange({target: {value,name}}){
        this.setState({
            [name] : value
        })
    }

    handleRaceDatetimeFrom(date){
        this.setState({
            RaceDateFrom: date.format("DD MMM YYYY (HH:mm a)")
        })
    }

    handleRaceDatetimeTo(date){
        this.setState({
            RaceDateTo: date.format("DD MMM YYYY (HH:mm a)")
        })
    }

    handleRaceDeadlineFrom(date){
        this.setState({
            RaceDeadlineFrom: date.format("DD MMM YYYY (HH:mm a)")
        })
    }

    handleRaceDeadlineTo(date){
        this.setState({
            RaceDeadlineTo: date.format("DD MMM YYYY (HH:mm a)")
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
                                                <label htmlFor="racetitle_en">Race Title<span className="required-field">*</span></label>
                                                <input onChange={this.handleInputChange} name="title_en" value={this.state.title_en} className="form-control" type="text" id="racetitle_en" required/>
                                            </TabPane>
                                            <TabPane tab="Ms" key="2">
                                                <label htmlFor="racetitle_ms">Race Title</label>
                                                <input onChange={this.handleInputChange} name="title_ms" value={this.state.title_ms} className="form-control" type="text" id="racetitle_ms"/>
                                            </TabPane>
                                            <TabPane tab="Zh" key="3">
                                                <label htmlFor="racetitle_zh">Race Title</label>
                                                <input onChange={this.handleInputChange} name="title_zh" value={this.state.title_zh} className="form-control" type="text" id="racetitle_zh"/>
                                            </TabPane>
                                        </Tabs>
                                    </div>
                                    <div className="form-row">
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                        <label htmlFor="price">Race Datetime<span className="required-field">*</span></label>
                                        <div className="form-row">
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ dateFrom } value={this.state.RaceDateFrom} onChange={this.handleRaceDatetimeFrom} dateFormat="DD MMM YYYY" timeFormat="(HH:mm a)"/>
                                            </div>
                                            <div className="col-sm-1">
                                            to
                                            </div>
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ dateFrom } value={this.state.RaceDateTo} onChange={this.handleRaceDatetimeTo} dateFormat="DD MMM YYYY" timeFormat="(HH:mm a)"/>
                                            </div>
                                         </div>
                                        </div>
                                    </div>
                                    <div className="col-sm-6">
                                        <div className="form-group">
                                        <label htmlFor="price">Registration Deadline<span className="required-field">*</span></label>
                                         <div className="form-row">
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ deadFrom } value={this.state.RaceDeadlineFrom} onChange={this.handleRaceDeadlineFrom} dateFormat="DD MMM YYYY" timeFormat="(HH:mm a)"/>
                                            </div>
                                            <div className="col-sm-1">
                                            to
                                            </div>
                                            <div className="col-sm-5">
                                            <Datetime isValidDate={ deadFrom } value={this.state.RaceDeadlineTo} onChange={this.handleRaceDeadlineTo} dateFormat="DD MMM YYYY" timeFormat="(HH:mm a)"/>
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
                                            <input onChange={this.handleInputChange} value={this.state.price} name="price" className="form-control" type="text" required/>
                                        </div>
                                    </div>
                                    </div>
                                    <div className="form-row">
                                    <div className="col-sm-2">
                                        <div className="form-group">
                                        <label>Engrave</label>
                                        <select value={this.state.engrave} onChange={this.handleEngraveChange} style={{'display': 'block'}}>
                                          <option value="no">No</option>
                                          <option value="yes">Yes</option>
                                        </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div className="form-group">
                                    <Tabs defaultActiveKey="1" type="card">
                                        <TabPane tab="En" key="1">
                                            <label htmlFor="about">About<span className="required-field">*</span></label>
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.about_en} onChange={this.handleAboutEnChange} required/>
                                            <input type="hidden" name="about_en" value={this.state.about_en}/>
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
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.medals_en} onChange={this.handleMedalsEnChange} required/>
                                            <input type="hidden" name="medals_en" value={this.state.medals_en}/>
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
                                            <ReactQuill style={{'minHeight':'500px'}} modules={this.modules} theme="snow"  value={this.state.awards_en} onChange={this.handleAwardsEnChange} required/>
                                            <input type="hidden" name="awards_en" value={this.state.awards_en}/>
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

if(document.getElementById('editraceform')){
    ReactDOM.render(<EditRaceForm />, document.getElementById('editraceform'))
}
