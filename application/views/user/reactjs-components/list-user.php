<?php $this->load->view('user/reactjs-components/Row'); ?>
<script type='text/babel'>
     class ListUser extends React.Component{
          state     =    {
               listUser  :    [],
               listUserImmutable   :    []
          }
          componentDidMount   =    ()   =>   {
               let listUser   =    [
                    {}, {}, {}, {}, {}, {}, {}, {}, {}
               ];
               let listUserImmutable    =    listUser;

               this.setState({listUser, listUserImmutable});

               $('#tabel-user').DataTable();
          }
          render(){
               let tS    =    this.state;

               return(
                    <table className={'table table-sm table-striped table-bordered'} id={'tabel-user'}>
                         <thead>
                              <tr>
                                   <th className={'text-center'}>No.</th>
                                   <th className={'text-left'}>Nama</th>
                                   <th className={'text-left'}>Username</th>
                                   <th className={'text-left'}>Email</th>
                                   <th className={'text-left'}>Level</th>
                                   <th className={'text-left'}>Status</th>
                              </tr>
                         </thead>
                         <tbody>
                              {tS.listUser.length >= 1 && tS.listUser.map((data, index) => {
                                   return    <Row key={index} nomorUrut={index+1} />;
                              })}
                         </tbody>
                    </table>
               );
          }
     }
     
     let place      =    document.getElementById('testReactJS');
     ReactDOM.render(<ListUser />, place);
</script>