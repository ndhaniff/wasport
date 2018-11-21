import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Button, Select, Table, List } from 'antd';
import axios from 'axios';
import CountUp from 'react-countup';

const columns = [{
  title: '#',
  dataIndex: 'rank',
  key: 'rank',
}, {
  title: 'Pelari',
  dataIndex: 'runner',
  key: 'runner',
  render: (text, record) => (
        <span>
          <img src={record.r_gender} />
          <b>{text}</b>
        </span>
      )
}, {
  title: '',
  dataIndex: 'r_gender',
  key: 'r_gender',
  render: (text) => (
   <div style={{'display' : 'none'}}></div>
 ),
}, {
  title: 'Pencapaian',
  dataIndex: 'result',
  key: 'result',
}];

class RankMs extends Component{

  constructor(){
    super();
    this.state = {
      rank: window.rank,
      race_category: window.race_category,
      gender: 'all',
      category: window.firstcategory,
      data: []
    }
  }

  createCategoryItems() {
    let category_items = [];
    let race_category = this.state.race_category;
    let items = category.split(',')

    for(var i=0; i<items.length; i++) {
      category_items.push(<option key={items[i]} value={items[i]}>{items[i]}</option>);
    }

    return category_items;
  }

  handleGenderChange = (genderChange) => {
    this.setState({ gender: genderChange })
  }

  handleCategoryChange = (categoryChange) => {
    this.setState({ category: categoryChange })
  }

  render(){

    let tabledata = []
    let j=1

    if(this.state.gender == 'all') {
      for(var i=0; i<rank.length; i++) {
        if(rank[i]['r_category'] == this.state.category) {
          if(rank[i]['r_gender'] == 'female')
            var r_gender = window.location.origin + '/img/ic-female.png'
          if(rank[i]['r_gender'] == 'male')
            var r_gender = window.location.origin + '/img/ic-male.png'

          let runner = rank[i]['firstname'] + ' ' + rank[i]['lastname']
          let result = rank[i]['pace_min'] + '"' + rank[i]['pace_sec']

          if(i==0)
            var ranking = <img src= {window.location.origin + '/img/ic-first.png'} />
          if(i==1)
            var ranking = <img src= {window.location.origin + '/img/ic-second.png'} />
          if(i==2)
            var ranking = <img src= {window.location.origin + '/img/ic-third.png'} />
          if(i!=0 && i!=1 && i!=2)
            var ranking = j

          tabledata.push({
            key: j,
            rank: ranking,
            r_gender: r_gender,
            runner: runner,
            result: result
          })
          j = j+1
        }
      }
    }

    if(this.state.gender == 'male') {
      for(var i=0; i<rank.length; i++) {
        if(rank[i]['r_gender'] == 'male' && rank[i]['r_category'] == this.state.category) {
          var r_gender = window.location.origin + '/img/ic-male.png'

          let runner = rank[i]['firstname'] + ' ' + rank[i]['lastname']
          let result = rank[i]['pace_min'] + '"' + rank[i]['pace_sec']

          if(i==0)
            var ranking = <img src= {window.location.origin + '/img/ic-first.png'} />
          if(i==1)
            var ranking = <img src= {window.location.origin + '/img/ic-second.png'} />
          if(i==2)
            var ranking = <img src= {window.location.origin + '/img/ic-third.png'} />
          if(i!=0 && i!=1 && i!=2)
            var ranking = j

          tabledata.push({
            key: j,
            rank: ranking,
            r_gender: r_gender,
            runner: runner,
            result: result
          })
          j = j+1
        }
      }
    }

    if(this.state.gender == 'female') {
      for(var i=0; i<rank.length; i++) {
        if(rank[i]['r_gender'] == 'female' && rank[i]['r_category'] == this.state.category) {
          var r_gender = window.location.origin + '/img/ic-female.png'

          let runner = rank[i]['firstname'] + ' ' + rank[i]['lastname']
          let result = rank[i]['pace_min'] + '"' + rank[i]['pace_sec']

          if(i==0)
            var ranking = <img src= {window.location.origin + '/img/ic-first.png'} />
          if(i==1)
            var ranking = <img src= {window.location.origin + '/img/ic-second.png'} />
          if(i==2)
            var ranking = <img src= {window.location.origin + '/img/ic-third.png'} />
          if(i!=0 && i!=1 && i!=2)
            var ranking = j

          tabledata.push({
            key: j,
            rank: ranking,
            r_gender: r_gender,
            runner: runner,
            result: result
          })
          j = j+1
        }
      }
    }

    return(
      <div>
          <Select defaultValue="all" style={{ width: 120 }} onChange={this.handleGenderChange}>
            <Option value="all">Semua</Option>
            <Option value="female">Perempuan</Option>
            <Option value="male">Lelaki</Option>
          </Select>

          <Select value={this.state.category} style={{ width: 120 }} onChange={this.handleCategoryChange}>
            {this.createCategoryItems()}
          </Select>

        <Table columns={columns} dataSource={tabledata} className="rank-table" />
      </div>
    )
  }

}

export default RankMs

if(document.getElementById('ranking-ms')){
    ReactDOM.render(<RankMs />, document.getElementById('ranking-ms'))
}
