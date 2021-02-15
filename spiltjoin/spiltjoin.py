from pathlib import Path
import click
import questionary


read_buffer_size = 1024


def _chunk_file(file, extension, destination, size):

    d = Path(destination)
    d.mkdir(parents=True, exist_ok=True)

    current_chunk_size = 0
    current_chunk = 1
    done_reading = False
    while not done_reading:
        with open(f'{destination}/{current_chunk}{extension}.chk', 'ab') as chunk:
            while True:
                bfr = file.read(read_buffer_size)
                if not bfr:
                    done_reading = True
                    break

                chunk.write(bfr)
                current_chunk_size += len(bfr)
                if current_chunk_size + read_buffer_size > size:
                    current_chunk += 1
                    current_chunk_size = 0
                    break


@click.command(name='split', help='split a file into chunks')
@click.option('-i', '--interactive', is_flag=True, help='to enable interactive mode')
@click.option('--file', help='path to the file that has to be split')
@click.option('--destination', default='.', help='path of the directory that will contain the chunks')
@click.option('--size', default=100000000, help='max size of a chunk')
def _split(interactive, file, destination, size):

    if not file and not interactive:
        print('file not valid')
        return
    
    if not file and interactive:
        p = Path.cwd()
        files = []
        for f in p.iterdir():
            if f.is_file():
                files.append(f.name)
        file_to_split = questionary.select('which file do you want to split?', choices=files).ask()
        file = Path(file_to_split)

    if interactive:
        destination = questionary.text('name the destination folder').ask()
        support = questionary.select('what chunk size do you desire?', 
        choices=['floppy', 'iomega_zip', 'cd', 'dvd']).ask()
        if support == 'floppy':
            size = 1400000
        elif support == 'iomega_zip':
            size = 100000000
        elif support == 'cd':
            size = 700000000
        elif support == 'dvd':
            size = 4500000000

    f = Path(file)
    
    if f.exists():
        with open(f, 'rb') as file_stream:
            _chunk_file(file_stream, f.suffix, destination, size)


@click.command(name='merge', help='merge pieces so that you obtain your original file')
@click.option('--source-dir', default='.', help='directory of where the chunks are')
@click.option('--output', default='merge', help='file name of the re-merged file')
def _(source_dir, output):
    p = Path(source_dir)
    if not p.exists():
        print('source folder not valid')
        return

    chunks = list(p.rglob('*.chk'))
    chunks.sort()
    extension = chunks[0].suffixes[0]

    with open(f'{output}{extension}', 'ab') as file:
        for chunk in chunks:   
            with open(chunk, 'rb') as piece:
                while True:
                    bfr = piece.read(read_buffer_size)
                    if not bfr:
                        break
                    file.write(bfr)


@click.group()
def main():
    print('split-merge files')


main.add_command(_split)
main.add_command(_merge)


if __name__ == '__main__':
    main()