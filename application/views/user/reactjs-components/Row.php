<script type='text/babel'>
     class Row extends React.Component{
          render(){
               let tP    =    this.props;
               let nomorUrut  =    tP.nomorUrut;

               return(
                    <tr className={'text-sm'}>
                         <td className={'text-center text-bold'}>{nomorUrut}.</td>
                         <td className={'text-left'}>
                              <h6 className={'mt-1 mb-1'}>Nama</h6>
                              <p className={'text-muted mb-1'} style={{fontSize:'8pt !important'}}>Jl. Alamat Medan</p>
                              <p className={'mt-1 mb-1'} style={{fontSize:'8pt !important'}}>Telepon 0812562345</p>
                         </td>
                         <td className={'text-left'}>Username</td>
                         <td className={'text-left'}>Email</td>
                         <td className={'text-left'}>Level</td>
                         <td className={'text-left'}>Status</td>
                    </tr>
               );
          }
     }
</script>